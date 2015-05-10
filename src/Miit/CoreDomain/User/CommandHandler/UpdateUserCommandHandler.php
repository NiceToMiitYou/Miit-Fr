<?php

namespace Miit\CoreDomain\User\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\User\User;
use Miit\CoreDomain\User\Command\UpdateUserCommand;

/**
 * Class UpdateUserCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class UpdateUserCommandHandler extends UserCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof UpdateUserCommand) {

            $user = $this->userRepository->findUserByUserId(
                $command->getUserId()
            );

            if(null !== $user) {
                $name = $command->getName();

                $user->update($name);

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
        return 'Miit\CoreDomain\User\Command\UpdateUserCommand';
    }
}
