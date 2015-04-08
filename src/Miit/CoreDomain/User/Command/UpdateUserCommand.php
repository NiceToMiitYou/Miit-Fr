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
    private $username;
    
    /**
     * @var Email
     */
    private $email;

    /**
     * @param UserId $userId
     * @param string $username
     * @param Email  $email
     */
    public function __construct(UserId $userId, $username, Email $email)
    {
        $this->userId   = $userId;
        $this->username = (string) $username;
        $this->email    = $email;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }
}
