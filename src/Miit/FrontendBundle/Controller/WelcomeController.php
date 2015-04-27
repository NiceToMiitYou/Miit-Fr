<?php

namespace Miit\FrontendBundle\Controller;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\RegisterUserCommand;
use Miit\CoreDomain\User\Command\PromoteUserCommand;
use Miit\CoreDomain\User\Command\AddTeamUserCommand;
use Miit\CoreDomain\Team\TeamId;
use Miit\CoreDomain\Team\Command\CreateTeamCommand;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Class WelcomeControlle
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class WelcomeController extends Controller
{
    /**
     * @Route("/", name="welcome_home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('MiitFrontendBundle:www:index.html.twig');
    }

    /**
     * @Route("/register",
     *      name="welcome_register",
     *      requirements={
     *          "_method":   "POST"
     *      }
     * )
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm('registration_type');
        $data = @json_decode($request->getContent(), true);

        $form->submit($data);

        $response = array(
            'done' => false
        );

        if ($form->isValid()) {

            $registration = $form->getData();

            // Process registration
            $userId     = UserId::newInstance();
            $email      = new Email($registration->user->email);

            $explode    = explode('@', $email->getValue());
            $username   = reset($explode);

            $generator  = new SecureRandom();
            $password   = bin2hex(
                $generator->nextBytes(8)
            );

            // Process team creation
            $teamId     = TeamId::newInstance();
            $name       = $registration->team->name;
            $slug       = strtolower($name);

            // Process roles for user
            $role_user  = strtoupper('ROLE_USER_'  . $teamId->getValue());
            $role_admin = strtoupper('ROLE_ADMIN_' . $teamId->getValue());

            // Entity manager
            $em         = $this->get('doctrine.orm.entity_manager');
            $team       = $em->getReference('Miit\CoreDomainBundle\Entity\Team', $teamId);

            // Instanciate commands
            $command_register_user = new RegisterUserCommand($userId, $username, $email, $password);

            $command_create_team   = new CreateTeamCommand($teamId, $slug, $name);

            $command_promote_user  = new PromoteUserCommand($userId, array(
                $role_admin,
                $role_user
            ));

            $command_add_team_user = new AddTeamUserCommand($userId, array(
                $team
            ));

            try {
                $this->get('command_bus')->dispatch($command_register_user);

                $this->get('user_manager')->sendNewUserEmail($email, $password);

                $this->get('command_bus')->dispatch($command_create_team);

                $this->get('command_bus')->dispatch($command_promote_user);

                $this->get('command_bus')->dispatch($command_add_team_user);

                $response['done'] = true;

            } catch(\Exception $e) {
                $response['errors'] = array();
                $response['errors'][] = $e->getMessage();
            }
        } else {

            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }
}
