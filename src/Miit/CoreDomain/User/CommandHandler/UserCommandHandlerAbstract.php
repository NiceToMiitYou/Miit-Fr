<?php

namespace Miit\CoreDomain\User\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandHandler;

use Miit\CoreDomain\User\UserFactory;
use Miit\CoreDomain\User\UserRepository;

/**
 * Class UserCommandHandlerAbstract
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class UserCommandHandlerAbstract implements CommandHandler
{
    /**
     * @var UserFactory
     */
    protected $userFactory;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserFactory    $userFactory
     * @param UserRepository $userRepository
     */
    public function __construct(UserFactory $userFactory, UserRepository $userRepository)
    {
        $this->userFactory    = $userFactory;
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function handle(Command $command);

    /**
     * {@inheritdoc}
     */
    abstract public function supportedCommand();
}
