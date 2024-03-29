<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\User\UserId;

/**
 * Class LockUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class LockUserCommand implements Command
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @param UserId $userId
     */
    public function __construct(UserId $userId)
    {
        $this->userId   = $userId;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
