<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\PromoteUserCommand;
use Miit\CoreDomain\User\Command\DemoteUserCommand;
use Miit\CoreDomain\User\Command\RemoveTeamUserCommand;
use Miit\CoreDomain\Team\Team;
use Miit\CoreDomain\Team\Command\UpdateTeamCommand;

use Miit\CoreDomainBundle\Annotation\Permissions;

use Miit\AppBundle\DTO\UserList;
use Miit\AppBundle\DTO\UserInvite;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use JMS\Serializer\SerializationContext;

/**
 * Class TeamController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @Route("/team")
 */
class TeamController extends AppControllerAbstract
{
    /**
     * @Route("/users",
     *      host="{team_slug}.{domain}",
     *      name="app_team_users",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "GET",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="USER")
     */
    public function listUsersAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');

        $response = new JsonResponse();
        $DTO      = new UserList();

        try {
            $teamId     = $this->getTeam()->getId();
            $users      = $this->get('user_repository')->findUsersByTeam($teamId);

            $DTO->users = $users;
            $DTO->done  = true;
        } catch(\Exception $ex) {}

        $context  = SerializationContext::create()->setGroups(array('default', 'list'));
        $data     = $serializer->serialize($DTO, 'json', $context);
        
        $response->setContent($data);

        return $response;
    }

    /**
     * @Route("/update",
     *      host="{team_slug}.{domain}",
     *      name="app_team_update",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="ADMIN")
     */
    public function updateAction(Request $request)
    {
        $form     = $this->validateForm('team_update_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $team   = $this->getTeam();
            $update = $form->getData();

            $teamId = $team->getId();
            $name   = $update->name;
            $public = $update->public;

            $command = new UpdateTeamCommand($teamId, $name, $public);

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

    /**
     * @Route("/invite",
     *      host="{team_slug}.{domain}",
     *      name="app_team_invite",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="ADMIN")
     */
    public function inviteUserAction(Request $request)
    {
        $form       = $this->validateForm('user_registration_type', $request);
        $serializer = $this->get('jms_serializer');

        $response = new JsonResponse();
        $DTO      = new UserInvite();

        if ($form->isValid())
        {
            $inviteUser = $form->getData();

            // Get data
            $teamId = $this->getTeam()->getId();
            $email  = new Email($inviteUser->email);

            $userId = $this->get('user_manager')->inviteInTeam($email, $teamId);

            if(null !== $userId) {
                $repository = $this->get('user_repository');
                $user       = $repository->findUserByEmail($email);

                $DTO->done = true;
                $DTO->user = $user;
            }
        }

        $context  = SerializationContext::create()->setGroups(array('default', 'details'));
        $data     = $serializer->serialize($DTO, 'json', $context);

        $response->setContent($data);

        return $response;
    }

    /**
     * @Route("/promote",
     *      host="{team_slug}.{domain}",
     *      name="app_team_promote_user",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="ADMIN")
     */
    public function promoteUserAction(Request $request)
    {
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
                $isOwner = $user->hasRole($team->getRole('OWNER'));

                if(false === $isOwner) {
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
                        $response['errors'] = array('CANNOT_PROMOTE_USER');
                    }
                } else {
                    $response['errors'] = array('USER_IS_OWNER');
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
     *      name="app_team_demote_user",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="ADMIN")
     */
    public function demoteUserAction(Request $request)
    {
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
                $isOwner = $user->hasRole($team->getRole('OWNER'));

                if(false === $isOwner) {
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
                        $response['errors'] = array('CANNOT_DEMOTE_USER');
                    }
                } else {
                    $response['errors'] = array('USER_IS_OWNER');
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
     * @Route("/remove",
     *      host="{team_slug}.{domain}",
     *      name="app_team_remove_user",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="ADMIN")
     */
    public function removeUserAction(Request $request)
    {
        $form     = $this->validateForm('remove_user_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $team       = $this->getTeam();
            $removeUser = $form->getData();
            $repository = $this->get('user_repository');

            $userId     = new UserId($removeUser->id);

            $user = $repository->findUserByUserIdAndTeamId($userId, $team->getId());

            if($user !== null) {
                $isAdmin = $user->hasRole($team->getRole('ADMIN'));
                $isOwner = $user->hasRole($team->getRole('OWNER'));

                if(true === $isOwner)
                {
                    $response['errors'] = array('USER_IS_OWNER');
                }
                else if(true === $isAdmin)
                {
                    $response['errors'] = array('USER_IS_ADMIN');
                }
                else
                {
                    try {
                        $command = new RemoveTeamUserCommand($userId, $team->getId());

                        $this->get('command_bus')->dispatch($command);

                        $response['done'] = true;
                    } catch(\Exception $exception) {
                        $response['errors'] = array('CANNOT_REMOVE_USER');
                    }
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
