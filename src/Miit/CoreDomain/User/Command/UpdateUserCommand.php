<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;

/**
 * Class UpdateUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class UpdateUserCommand implements Command
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $name;

    /**
     * @param UserId $userId
     * @param string $name
     */
    public function __construct(UserId $userId, $name)
    {
        $this->userId = $userId;
        $this->name   = (string) $name;
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
    public function getName()
    {
        return $this->name;
    }
}
