<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\User\UserId;

/**
 * Class PromoteUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class PromoteUserCommand implements Command
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $role;

    /**
     * @param UserId $userId
     * @param string $role
     */
    public function __construct(UserId $userId, $role)
    {
        $this->userId = $userId;
        $this->role   = (string) $role;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}
