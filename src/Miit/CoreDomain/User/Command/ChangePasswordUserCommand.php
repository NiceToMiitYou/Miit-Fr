<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;

/**
 * Class ChangePasswordUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class ChangePasswordUserCommand implements Command
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $password;

    /**
     * @param UserId $userId
     * @param string $password
     */
    public function __construct(UserId $userId, $password)
    {
        $this->userId   = $userId;
        $this->password = (string) $password;
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
    public function getPassword()
    {
        return $this->password;
    }
}
