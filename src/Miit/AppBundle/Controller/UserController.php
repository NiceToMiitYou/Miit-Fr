<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\ChangePasswordUserCommand;
use Miit\CoreDomain\User\Command\PromoteUserCommand;
use Miit\CoreDomain\User\Command\DemoteUserCommand;
use Miit\CoreDomain\Team\Team;

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
     * @Route("/promote",
     *      host="{team_slug}.{domain}",
     *      name="app_user_promote_user",
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
    public function promoteUserAction(Request $request)
    {
        $this->checkRole('ADMIN');

        $form     = $this->validateForm('promote_user_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $team        = $this->getTeam();
            $promoteUser = $form->getData();
            $repository  = $this->get('user_repository');

            $userId      = new UserId($promoteUser->id);

            $user = $repository->findUserByUserIdAndTeamId($userId, $team->getId());

            if($user !== null) {
                $roles = array();

                // If you promote an user of the role ADMIN
                // be sure that USER is here
                if(true === in_array('ADMIN', $promoteUser->roles, true)) {
                    array_push($promoteUser->roles, 'USER');
                }

                // Use correct role specification
                foreach ($promoteUser->roles as $role) {
                    array_push($roles, $team->getRole($role));
                }

                try {
                    $command = new PromoteUserCommand($userId, $roles);

                    $this->get('command_bus')->dispatch($command);

                    $response['done'] = true;
                } catch(\Exception $exception) {
                    $response['ex'] =  sprintf('%s', $exception);
                    $response['errors'] = array('CANNOT_PROMOTE_USER');
                }
            } else {
                $response['errors'] = array('NO_USER_FOUND');
            }
        } else {
            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/demote",
     *      host="{team_slug}.{domain}",
     *      name="app_user_demote_user",
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
    public function demoteUserAction(Request $request)
    {
        $this->checkRole('ADMIN');

        $form     = $this->validateForm('demote_user_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $team       = $this->getTeam();
            $demoteUser = $form->getData();
            $repository = $this->get('user_repository');

            $userId     = new UserId($demoteUser->id);

            $user = $repository->findUserByUserIdAndTeamId($userId, $team->getId());

            if($user !== null) {
                $roles = array();

                // If you demote an user of the role USER
                // be sure that ADMIN is gone too
                if(true === in_array('USER', $demoteUser->roles, true)) {
                    array_push($demoteUser->roles, 'ADMIN');
                }

                // Use correct role specification
                foreach ($demoteUser->roles as $role) {
                    array_push($roles, $team->getRole($role));
                }

                try {
                    $command = new DemoteUserCommand($userId, $roles);

                    $this->get('command_bus')->dispatch($command);

                    $response['done'] = true;
                } catch(\Exception $exception) {
                    $response['ex'] =  sprintf('%s', $exception);
                    $response['errors'] = array('CANNOT_DEMOTE_USER');
                }
            } else {
                $response['errors'] = array('NO_USER_FOUND');
            }
        } else {
            $response['errors'] = $form->getErrors();
        }

        return new JsonResponse($response);
    }
}
