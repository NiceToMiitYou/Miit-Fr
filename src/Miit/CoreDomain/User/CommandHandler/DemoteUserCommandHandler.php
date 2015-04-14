<?php

namespace Miit\CoreDomain\User\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\User\User;
use Miit\CoreDomain\User\Command\DemoteUserCommand;

/**
 * Class DemoteUserCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class DemoteUserCommandHandler extends UserCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof DemoteUserCommand) {

            $user = $this->userRepository->findUserByUserId(
                $command->getUserId()
            );

            if(null !== $user) {

                // Get the list of roles
                $roles = $command->getRoles();

                // For each roles
                foreach ($roles as $role) {
                    $user->demote($role);
                }

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
        return 'Miit\CoreDomain\User\Command\DemoteUserCommand';
    }
}
