<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;

/**
 * Class RegisterUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class RegisterUserCommand implements Command
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
     * @var string
     */
    private $password;

    /**
     * @param UserId $userId
     * @param string $username
     * @param Email  $email
     * @param string $password
     */
    public function __construct(UserId $userId, $username, Email $email, $password)
    {
        $this->userId   = $userId;
        $this->username = (string) $username;
        $this->email    = $email;
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

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
