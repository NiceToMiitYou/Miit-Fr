<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\User\User;
use Miit\CoreDomain\User\Command\RemoveUserTeamCommand;

/**
 * Class RemoveUserTeamCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class RemoveUserTeamCommandHandler extends TeamCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof RemoveUserTeamCommand) {

            $team = $this->teamRepository->findTeamByTeamIdWithUsers(
                $command->getTeamId()
            );

            if(null !== $team) {

                // Get the list of users
                $users     = $command->getUsers();
                $teamUsers = $team->getUsers();

                // For each teams
                foreach ($users as $user) {

                    // For each user's team
                    foreach ($teamUsers as $teamUser) {

                        // Same id
                        if($teamUser->getId()->getValue() === $user->getValue()) {
                            $team->removeUser($teamUser);
                            break;
                        }
                    }
                }

                // Persist the team
                $this->teamRepository->persist($team);
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
        return 'Miit\CoreDomain\User\Command\RemoveUserTeamCommand';
    }
}
