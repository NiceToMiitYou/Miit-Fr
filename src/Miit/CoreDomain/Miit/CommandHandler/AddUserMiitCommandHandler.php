<?php

namespace Miit\CoreDomain\Miit\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Miit\Command\AddUserMiitCommand;

/**
 * Class AddUserMiitCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class AddUserMiitCommandHandler extends MiitCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof AddUserMiitCommand) {

            $miit = $this->miitRepository->findMiitByMiitId(
                $command->getMiitId()
            );

            if(null !== $miit) {

                // Get the list of users
                $users = $command->getUsers();

                // For each users
                foreach ($users as $user) {
                    $miit->addUser($user);
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
        return 'Miit\CoreDomain\Miit\Command\AddUserMiitCommand';
    }
}
