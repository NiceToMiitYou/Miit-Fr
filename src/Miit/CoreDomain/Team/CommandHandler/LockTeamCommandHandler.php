<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Team\Team;
use Miit\CoreDomain\Team\Command\LockTeamCommand;

/**
 * Class LockTeamCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class LockTeamCommandHandler extends TeamCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof LockTeamCommand) {

            $team = $this->teamRepository->findTeamByTeamId(
                $command->getTeamId();
            );

            $team->lock();

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
        return 'Miit\CoreDomain\Team\Command\LockTeamCommand';
    }
}
