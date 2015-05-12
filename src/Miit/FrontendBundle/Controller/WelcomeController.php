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
     * @Route("/",
     *      host="{subdomain}.{domain}",
     *      defaults={
     *          "domain":    "%domain%",
     *          "subdomain": "www"
     *      },
     *      requirements={
     *          "domain":    "%domain%",
     *          "subdomain": "www"
     *      }
     * )
     * @Route("/",
     *      host="{domain}",
     *      name="welcome_home",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "domain":    "%domain%"
     *      }
     * )
     */
    public function indexAction(Request $request)
    {
        return $this->render('MiitFrontendBundle:www:index.html.twig');
    }

    /**
     * @Route("/register",
     *      host="{subdomain}.{domain}",
     *      defaults={
     *          "domain":    "%domain%",
     *          "subdomain": "www"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "subdomain": "www"
     *      }
     * )
     * @Route("/register",
     *      name="welcome_register",
     *      host="{domain}",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%"
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

                $roles  = array('OWNER', 'ADMIN', 'USER');

                // Invite or create the user in the new team
                $userId = $userManager->inviteInTeam($email, $teamId, $roles, true);

                // If user created or/and invited
                if(null !== $userId) {
                    $response['done'] = true;
                    $response['slug'] = $teamManager->slugOf($name);
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
