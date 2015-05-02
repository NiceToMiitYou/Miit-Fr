<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;

/**
 * Class CreateUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class CreateUserCommand implements Command
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
     * @var Email
     */
    private $email;
    
    /**
     * @var array
     */
    private $roles;

    /**
     * @param UserId $userId
     * @param string $name
     * @param Email  $email
     * @param array  $roles
     */
    public function __construct(UserId $userId, $name, Email $email, $roles = array())
    {
        $this->userId   = $userId;
        $this->name = (string) $name;
        $this->email    = $email;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
