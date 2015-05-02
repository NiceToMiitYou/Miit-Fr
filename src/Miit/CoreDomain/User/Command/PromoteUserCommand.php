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
     * @var array
     */
    private $roles;

    /**
     * @param UserId $userId
     * @param string $roles
     */
    public function __construct(UserId $userId, $roles)
    {
        $this->userId = $userId;
        if(is_array($roles)) {
            $this->roles = $roles;
        } else {
            $this->roles = array($roles);
        }
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
