<?php

namespace Miit\CoreDomain\User;

use DomainDrivenDesign\Domain\Model\Factory;

use Miit\CoreDomain\Common\Email;

/**
 * Interface UserFactory
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface UserFactory extends Factory
{
    /**
     * Return a new instance of user
     * 
     * @param UserId $userId
     * @param string $username
     * @param Email  $email
     * 
     * @return User
     */
    public function newIntance(UserId $userId, $username, Email $email);
}
