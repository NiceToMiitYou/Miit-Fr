<?php

namespace Miit\CoreDomain\User\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\User\User;
use Miit\CoreDomain\User\Command\RemoveTeamUserCommand;

/**
 * Class RemoveTeamUserCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class RemoveTeamUserCommandHandler extends UserCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof RemoveTeamUserCommand) {

            $user = $this->userRepository->findUserByUserIdWithTeams(
                $command->getUserId()
            );

            if(null !== $user) {

                // Get the list of teams
                $teams     = $command->getTeams();
                $userTeams = $user->getTeams();

                // For each teams
                foreach ($teams as $team) {

                    // For each user's team
                    foreach ($userTeams as $userTeam) {

                        // Same id
                        if($userTeam->getId()->getValue() === $team->getValue()) {
                            $user->removeTeam($userTeam);
                            break;
                        }
                    }
                }

                // Persist the user
                $this->userRepository->persist($user);
            }
        } else {

            throw new CommandNotSupportedByHandler($this, $command);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedCommand()
    {
        return 'Miit\CoreDomain\User\Command\RemoveTeamUserCommand';
    }
}
