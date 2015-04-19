<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\ChangePasswordUserCommand;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller
{
    /**
     * @Route("/user/change_password",
     *      host="{team_slug}.{domain}",
     *      name="app_user_change_password",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     */
    public function changePasswordAction(Request $request)
    {
        $form = $this->createForm('user_change_password_type');

        $form->handleRequest($request);
   
        $response = array(
            'done' => false
        );

        if ($form->isValid()) {

            $changePassword = $form->getData();

            $userId   = $this->getUser()->getId();

            $password = $changePassword->password;

            $command = new ChangePasswordUserCommand($userId, $password);

            try {
                $this->get('command_bus')->dispatch($command);

                $response['done'] = true;
            } catch (\Exception $e) {

                $response['errors'][] = $e->getMessage();
            }
        } else {

            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }
}
