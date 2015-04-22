<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\User\User;
use Miit\CoreDomain\User\Command\AddUserTeamCommand;

/**
 * Class AddUserTeamCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class AddUserTeamCommandHandler extends TeamCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof AddUserTeamCommand) {

            $team = $this->teamRepository->findTeamByTeamId(
                $command->getTeamId()
            );

            if(null !== $team) {

                // Get the list of users
                $users = $command->getUsers();

                // For each users
                foreach ($users as $user) {
                    $team->addTeam($user);
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
        return 'Miit\CoreDomain\User\Command\AddUserTeamCommand';
    }
}
