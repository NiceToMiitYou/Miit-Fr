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
            $userManager  = $this->get('user_manager');
            $teamManager  = $this->get('team_manager');

            // Process registration
            $email  = new Email($registration->user->email);
            $name   = $registration->team->name;

            // Create the team
            $teamId = $teamManager->createTeam($name);

            // If team created
            if(null !== $teamId) {

                // Invite or create the user in the new team
                $userId = $userManager->inviteInTeam($email, $teamId, array('ADMIN', 'USER'));

                // If user created or/and invited
                if(null !== $userId) {
                    $response['done'] = true;
                } else {
                    $response['errors'] = array('USER_NOT_CREATED');
                }
            } else {
                $response['errors'] = array('TEAM_NOT_CREATED');
            }
        } else {
            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }
}
