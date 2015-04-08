<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Team\Team;
use Miit\CoreDomain\Team\Command\CreateTeamCommand;

/**
 * Class CreateTeamCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class CreateTeamCommandHandler extends TeamCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof CreateTeamCommand) {

            $team = $this->teamFactory->newIntance(
                $command->getTeamId(),
                $command->getSlug(),
                $command->getName()
            );

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
        return 'Miit\CoreDomain\Team\Command\CreateTeamCommand';
    }
}
