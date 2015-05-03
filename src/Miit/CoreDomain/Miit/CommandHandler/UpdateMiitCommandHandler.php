<?php

namespace Miit\CoreDomain\Miit\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Miit\Command\UpdateMiitCommand;

/**
 * Class UpdateMiitCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class UpdateMiitCommandHandler extends MiitCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof UpdateMiitCommand) {

            $miit = $this->teamRepository->findMiitByMiitId(
                $command->getMiitId()
            );

            $mitt->update(
                $command->getName(),
                $command->getState(),
                $command->getPublic()
            );

            // Persist the miit
            $this->miitRepository->persist($miit);
        } else {

            throw new CommandNotSupportedByHandler($this, $command);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedCommand()
    {
        return 'Miit\CoreDomain\Miit\Command\UpdateMiitCommand';
    }
}
