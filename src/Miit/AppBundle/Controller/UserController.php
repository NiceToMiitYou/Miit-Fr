<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\ChangePasswordUserCommand;
use Miit\CoreDomain\User\Command\UpdateUserCommand;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UserController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @Route("/user")
 */
class UserController extends AppControllerAbstract
{
    /**
     * @Route("/change_password",
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
        $form     = $this->validateForm('user_change_password_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $user           = $this->getUser();
            $changePassword = $form->getData();

            $userId         = $user->getId();
            $password_old   = $changePassword->password_old;
            $password_new   = $changePassword->password_new;

            $encoder        = $this->get('security.encoder_factory')->getEncoder($user);

            if (
                $encoder->isPasswordValid($user->getPassword(), $password_old, $user->getSalt())
            ) {
                $command = new ChangePasswordUserCommand($userId, $password_new);

                try {
                    $this->get('command_bus')->dispatch($command);

                    $response['done'] = true;
                } catch (\Exception $e) {

                    $response['errors'][] = $e->getMessage();
                }
            }
        } else {

            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/update",
     *      host="{team_slug}.{domain}",
     *      name="app_user_update",
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
    public function updateAction(Request $request)
    {
        $form     = $this->validateForm('user_update_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $user   = $this->getUser();
            $update = $form->getData();

            $userId = $user->getId();
            $name   = $update->name;

            $command = new UpdateUserCommand($userId, $name);

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
