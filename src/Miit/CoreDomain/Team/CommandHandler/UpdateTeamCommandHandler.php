<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Team\Team;
use Miit\CoreDomain\Team\Command\UpdateTeamCommand;

/**
 * Class UpdateTeamCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class UpdateTeamCommandHandler extends TeamCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof UpdateTeamCommand) {

            $team = $this->teamRepository->findTeamByTeamId(
                $command->getTeamId()
            );

            $name   = $command->getName();
            $public = $command->getPublic();

            $team->update($name, $public);

            // Persist the team
            $this->teamRepository->persist($team);
        } else {

            throw new CommandNotSupportedByHandler($this, $command);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedCommand()
    {
        return 'Miit\CoreDomain\Team\Command\UpdateTeamCommand';
    }
}
