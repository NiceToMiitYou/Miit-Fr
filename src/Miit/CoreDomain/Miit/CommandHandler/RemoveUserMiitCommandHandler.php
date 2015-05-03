<?php

namespace Miit\CoreDomain\Miit\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Miit\Command\RemoveUserMiitCommand;

/**
 * Class RemoveUserMiitCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class RemoveUserMiitCommandHandler extends MiitCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof RemoveUserMiitCommand) {

            $miit = $this->miitRepository->findMiitByMiitId(
                $command->getMiitId()
            );

            if(null !== $miit) {

                // Get the list of users
                $users = $command->getUsers();

                // For each users
                foreach ($users as $user) {
                    $miit->removeUser($user);
                }

                // Persist the miit
                $this->miitRepository->persist($miit);
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
        return 'Miit\CoreDomain\Miit\Command\RemoveUserMiitCommand';
    }
}
