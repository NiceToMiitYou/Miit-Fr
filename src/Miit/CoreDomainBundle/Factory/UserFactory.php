<?php

namespace Miit\CoreDomainBundle\Factory;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\UserFactory as UserFactoryInterface;

use Miit\CoreDomainBundle\Entity\User;

/**
 * Class UserFactory
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserFactory implements UserFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function newIntance(UserId $userId, $username, Email $email)
    {
        return new User($userId, $username, $email);
    }
}
