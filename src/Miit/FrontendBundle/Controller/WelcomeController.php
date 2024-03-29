<?php

namespace Miit\FrontendBundle\Controller;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\RegisterUserCommand;
use Miit\CoreDomain\User\Command\PromoteUserCommand;
use Miit\CoreDomain\User\Command\AddTeamUserCommand;
use Miit\CoreDomain\Team\TeamId;
use Miit\CoreDomain\Team\Command\CreateTeamCommand;

use Miit\CoreDomainBundle\Entity\NewsLetter;

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
     *      name="welcome_home",
     *      defaults={
     *          "domain":    "%domain%",
     *          "subdomain": "www"
     *      },
     *      requirements={
     *          "domain":    "%domain%",
     *          "subdomain": "www"
     *      }
     * )
     */
    public function indexAction(Request $request)
    {
        return $this->render('MiitFrontendBundle:www:index.html.twig');
    }

    /**
     * @Route("/{nothing}",
     *      host="{domain}",
     *      defaults={
     *          "domain":    "%domain%",
     *          "nothing":   ""
     *      },
     *      requirements={
     *          "domain":    "%domain%",
     *          "nothing":   "[a-zA-Z0-9-+_/\s]+"
     *      }
     * )
     * @Route("/{nothing}",
     *      host="{ip}",
     *      defaults={
     *          "nothing":   ""
     *      },
     *      requirements={
     *          "ip":      "[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+",
     *          "nothing": "[a-zA-Z0-9-+_/\s]+"
     *      }
     * )
     */
    public function redirectHomeAction(Request $request)
    {
        return  $this->redirect($this->generateUrl('welcome_home'), 301);
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

    /**
     * @Route("/newsletter",
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
     * @Route("/newsletter",
     *      name="welcome_newsletter",
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
    public function newsLetterAction(Request $request)
    {
        $form = $this->createForm('news_letter_type');
        $data = @json_decode($request->getContent(), true);

        $form->submit($data);

        $response = array(
            'done' => false
        );

        if ($form->isValid()) {

            $repository = $this->get('news_letter_repository');

            $newsletter = $form->getData();
            // Process registration
            $email = new Email($newsletter->email);

            try {
                $new = new NewsLetter($email);

                $repository->persist($new);
            } catch(\Exception $e) {
                // Don't throw, probably already exist, do not notfiy client
            }

            $response['done'] = true;

        } else {
            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }
}
