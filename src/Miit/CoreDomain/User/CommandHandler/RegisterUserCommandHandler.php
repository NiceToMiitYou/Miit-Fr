<?php

namespace Miit\CoreDomain\User\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\User\User;
use Miit\CoreDomain\User\Command\RegisterUserCommand;

/**
 * Class RegisterUserCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class RegisterUserCommandHandler extends UserCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof RegisterUserCommand) {

            $user = $this->userFactory->newIntance(
                $command->getUserId(),
                $command->getUsername(),
                $command->getEmail()
            );

            // Register the password
            $user->register($command->getPassword());

            // Persist the user
            $this->userRepository->persist($user);
        } else {

            throw new CommandNotSupportedByHandler($this, $command);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedCommand()
    {
        return 'Miit\CoreDomain\User\Command\RegisterUserCommand';
    }
}
