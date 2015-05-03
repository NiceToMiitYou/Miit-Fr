<?php

namespace Miit\CoreDomain\Miit\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Miit\Miit;
use Miit\CoreDomain\Miit\Command\CreateTeamCommand;

/**
 * Class CreateMiitCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class CreateMiitCommandHandler extends MiitCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof CreateMiitCommand) {

            $team = $this->miitFactory->newIntance(
                $command->getMiitId(),
                $command->getToken(),
                $command->getName(),
                $command->getTeam(),
                $command->getPublic()
            );

            // Persist the team
            $this->miitFactory->persist($miit);
        } else {

            throw new CommandNotSupportedByHandler($this, $command);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedCommand()
    {
        return 'Miit\CoreDomain\Miit\Command\CreateMiitCommand';
    }
}
