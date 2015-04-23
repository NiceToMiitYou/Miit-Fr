<?php

namespace Miit\CoreDomain\User;

use DomainDrivenDesign\Domain\Model\Repository;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\Team\Team;

/**
 * Interface UserRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface UserRepository extends Repository
{
    /**
     * Return the user based on his id
     * 
     * @param UserId $userid
     * 
     * @return User
     */
    public function findUserByUserId(UserId $userId);

    /**
     * Return the user based on his email
     * 
     * @param Email $email
     * 
     * @return User
     */
    public function findUserByEmail(Email $email);

    /**
     * Return the list of user based on the team
     * 
     * @param Team $team
     * 
     * @return array
     */
    public function findUsersByTeam(Team $team);

    /**
     * Return the user based on his name
     * 
     * @param string $username
     * 
     * @return User
     */
    public function loadUserByUsername($username);

    /**
     * Persist the given User
     * 
     * @param User $user
     */
    public function persist(User $user);
}
