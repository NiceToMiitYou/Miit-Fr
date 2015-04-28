<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\ChangePasswordUserCommand;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @Route("/promote/{id}",
     *      host="{team_slug}.{domain}",
     *      name="app_user_promote_user",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}",
     *          "id":        "[0-9a-f]{8}-[0-9a-f]{4}-5[0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}"
     *      }
     * )
     */
    public function promoteUserAction(Request $request, $id)
    {
        $this->checkRole('ADMIN');

        $form     = $this->validateForm('promote_user_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $team        = $this->getTeam();
            $promoteUser = $form->getData();

            die(var_dump($promoteUser));
        }

        return new JsonResponse($response);
    }
}
