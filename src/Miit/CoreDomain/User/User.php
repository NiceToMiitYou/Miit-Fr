<?php

namespace Miit\CoreDomain\User;

use DomainDrivenDesign\Domain\Model\Entity;

use Miit\CoreDomain\Common\Email;

/**
 * Class User
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class User implements Entity
{
    /**
     * The unique id of the user
     * 
     * @var UserId 
     */
    protected $id;

    /**
     * The email of the user
     * 
     * @var Email
     */
    protected $email;

    /**
     * The name of the user
     * 
     * @var string
     */
    protected $name;

    /**
     * The encrypted password
     *
     * @var string
     */
    protected $password;

    /**
     * The salt of the password
     *
     * @var string
     */
    protected $salt;

    /**
     * The roles of the user
     *
     * @var array
     */
    protected $roles;

    /**
     * Define if the user is locked
     * 
     * @var boolean
     */
    protected $locked;

    /**
     * The list of affiliate teams
     * 
     * @var array
     */
    protected $teams;

    /**
     * The registration date
     *
     * @var \DateTime
     */
    protected $registeredAt;

    /**
     * The last time that
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Instanciate a new User
     * 
     * @param UserId $id
     * @param Email  $email
     * @param string $name
     */
    public function __construct(UserId $id, $name, Email $email)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->email  = $email;
        $this->locked = false;
        $this->roles  = array('ROLE_USER');
    }

    /**
     * 
     * Actions for the user
     * 
     */

    /**
     * Register the user with a password
     * 
     * @param string $password
     */
    public function register($password, $salt = '')
    {
        // Set the password
        $this->password = $password;

        // Set the salt of the password
        $this->salt     = $salt;

        // Set the registered time
        $this->registeredAt = new \DateTime();
    }

    /**
     * Update password
     * 
     * @param string $password
     */
    public function changePassword($password, $salt = '')
    {
        // Set the password
        $this->password  = $password;

        // Set the salt of the password
        $this->salt      = $salt;

        // Set the updated time
        $this->updatedAt = new \DateTime();
    }

    /**
     * @param string $name
     * @param Email  $email
     */
    public function update($name, Email $email)
    {
        $this->name      = $name;
        $this->email     = $email;
        $this->updatedAt = new \DateTime();
    }

    /**
     * Lock the user
     */
    public function lock()
    {
        $this->locked    = true;
        $this->updatedAt = new \DateTime();
    }

    /**
     * Unlock the user
     */
    public function unlock()
    {
        $this->locked    = false;
        $this->updatedAt = new \DateTime();
    }

    /**
     * Promote the user
     */
    public function promote($role)
    {
        if(false === $this->hasRole($role)) {
            
            // Push the role at the end of the array
            array_push($this->roles, $role);

            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * Demote the user
     */
    public function demote($role)
    {
        if(true === $this->hasRole($role)) {

            // Find the key
            $key = array_search($role, $this->roles);
            
            // Remove it
            unset($this->roles[$key]);

            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @param string $team
     * 
     * Add the reference to a team
     */
    public function addTeam($team)
    {
        if(false === $this->hasTeam($team)) {
            
            // Push the team at the end of the array
            array_push($this->teams, $team);
        }
    }

    /**
     * @param string $team
     * 
     * Remove the reference to a team
     */
    public function removeTeam($team)
    {
        if(true === $this->hasTeam($team)) {

            // Find the key
            $key = array_search($team, $this->teams);
            
            // Remove it
            unset($this->teams[$key]);
        }
    }

    /**
     * @return boolean 
     */
    public function equals(User $user)
    {
        if($this->id->getValue() !== $user->getId()->getValue()) {
            return false;
        }

        return true;
    }

    /**
     * 
     * Getters for the user
     * 
     */

    /**
     * @return UserId 
     */
    public function getId()
    {
        if(true === is_string($this->id))
        {
            $this->id = new UserId($this->id);
        }

        return $this->id;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUsername()
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

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $role
     * 
     * @return boolean
     */
    public function hasRole($role)
    {
        return in_array($role, $this->roles, true);
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return (boolean) $this->locked;
    }

    /**
     * @return array
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param string $team
     * 
     * @return boolean
     */
    public function hasTeam($team)
    {
        return in_array($team, $this->teams, true);
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
