<?php

namespace Miit\CoreDomainBundle\Manager;

use DomainDrivenDesign\Domain\Command\CommandBus as CommandBusInterface;

use Miit\CoreDomainBundle\Repository\UserRepository;
use Miit\CoreDomainBundle\Repository\TeamRepository;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\RegisterUserCommand;
use Miit\CoreDomain\User\Command\PromoteUserCommand;
use Miit\CoreDomain\User\Command\AddTeamUserCommand;
use Miit\CoreDomain\Team\TeamId;
use Miit\CoreDomain\Team\Team;

use Symfony\Component\Security\Core\Util\SecureRandom;

use Monolog\Logger;

/**
 * Class UserManager
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserManager
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * @var EmailManager
     */
    private $emailManager;

    /**
     * @param Logger              $logger
     * @param CommandBusInterface $commandBus
     * @param UserRepository      $userRepository
     * @param TeamRepository      $teamRepository
     * @param EmailManager        $emailManager
     */
    public function __construct(
        Logger              $logger,
        CommandBusInterface $commandBus,
        UserRepository      $userRepository,
        TeamRepository      $teamRepository
    ) {
        $this->logger         = $logger;
        $this->commandBus     = $commandBus;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param EmailManager $emailManager
     */
    public function setEmailManager(EmailManager $emailManager)
    {
        $this->emailManager = $emailManager;
    }

    /**
     * @param Email $email
     * 
     * @return UserId
     */
    private function getUserIdOrNewByEmail(Email $email)
    {
        $user = $this->userRepository->findUserByEmail($email);
        
        if(null !== $user)
            return $user->getId();
        else
            return $this->createNewUser($email);
    }

    /**
     * @param Email $email
     * 
     * @return UserId
     */
    private function createNewUser(Email $email)
    {
        // Process registration
        $userId     = UserId::newInstance();

        $explode    = explode('@', $email->getValue());
        $username   = reset($explode);

        $generator  = new SecureRandom();
        $password   = bin2hex(
            $generator->nextBytes(8)
        );

        $command = new RegisterUserCommand($userId, $username, $email, $password);

        try {
            // Register the user
            $this->commandBus->dispatch($command);

            // then send the password
            $this->emailManager->sendNewUser($email, $password);
        } catch (\Exception $exception) {

            $this->logger->crit('The user could not be created.', array(
                'user_id'  => sprintf('%s', $userId),
                'email'    => sprintf('%s', $email),
                'username' => $username,
                'password' => $password,
                'error'    => sprintf('%s', $exception),
            ));

            $userId = null;
        }

        return $userId;
    }

    /**
     * @param Email   $email
     * @param TeamId  $teamId
     * @param array   $roles
     * @param boolean $newTeam
     * 
     * @return UserId
     */
    public function inviteInTeam(Email $email, TeamId $teamId, array $roles = array('USER'), $newTeam = false)
    {
        $userId = $this->getUserIdOrNewByEmail($email);

        if(null !== $userId) {
            $finalRoles = array();

            foreach($roles as $role) {
                array_push($finalRoles,
                    Team::getRoleDefinition($teamId, $role)
                );
            }

            $command_promote = new PromoteUserCommand($userId, $finalRoles);
            $command_add     = new AddTeamUserCommand($userId, array(
                $this->teamRepository->getReference($teamId)
            ));

            try {
                // Process commands
                $this->commandBus->dispatch($command_add);
                $this->commandBus->dispatch($command_promote);
                
                // Notify the user
                if(true === $newTeam)
                {
                    $this->emailManager->sendCreatedTeam($email);
                }
                else
                {
                    $this->emailManager->sendInviteUser($email);
                }
            } catch (\Exception $exception) {

                $this->logger->crit('The user could not be promoted.', array(
                    'user_id'     => sprintf('%s', $userId),
                    'email'       => sprintf('%s', $email),
                    'team'        => sprintf('%s', $teamId),
                    'roles'       => $roles,
                    'final_roles' => $finalRoles,
                    'error'       => sprintf('%s', $exception),
                ));

                $userId = null;
            }
        }

        return $userId;
    }
}