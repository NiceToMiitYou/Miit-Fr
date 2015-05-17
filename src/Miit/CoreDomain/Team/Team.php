<?php

namespace Miit\CoreDomain\Team;

use DomainDrivenDesign\Domain\Model\Entity;

/**
 * Class Team
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class Team implements Entity
{
    /**
     * The unique id of the team
     * 
     * @var TeamId 
     */
    protected $id;

    /**
     * The slug of the team
     * 
     * @var string
     */
    protected $slug;

    /**
     * The name of the team
     * 
     * @var string
     */
    protected $name;

    /**
     * Define if the miit is public
     * 
     * @var boolean
     */
    protected $public;

    /**
     * Define if the team is locked
     * 
     * @var boolean
     */
    protected $locked;

    /**
     * The list of users
     * 
     * @var array
     */
    protected $users;

    /**
     * The list of application
     * 
     * @var array
     */
    protected $applications;

    /**
     * The creation date
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * The last time that
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Instanciate a new Team
     * 
     * @param TeamId $id
     * @param string $slug
     * @param string $name
     */
    public function __construct(TeamId $id, $slug, $name)
    {
        $this->id           = $id;
        $this->slug         = (string) $slug;
        $this->name         = (string) $name;
        $this->locked       = false;
        $this->public       = false;
        $this->applications = array(
            'APP_CHAT', 'APP_QUIZZ', 'APP_DOCUMENTS'
        );
    }

    /**
     * 
     * Actions for the team
     * 
     */

    /**
     * Define the team as created
     */
    public function create()
    {
        if(null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
    }

    /**
     * @param string $username
     */
    public function update($name, $public)
    {
        $this->name      = $name;
        $this->public    = $public;
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
     * @param string $user
     * 
     * Add the reference to an user
     */
    public function addUser($user)
    {
        if(false === $this->hasUser($user)) {
            
            // Push the user at the end of the array
            array_push($this->users, $user);
        }
    }

    /**
     * @param string $user
     * 
     * Remove the reference to an user
     */
    public function removeUser($user)
    {
        if(true === $this->hasUser($user)) {

            // Find the key
            $key = array_search($user, $this->users);
            
            // Remove it
            unset($this->users[$key]);
        }
    }

    /**
     * @param string $application
     * 
     * Add the reference to an application
     */
    public function addApplication($application)
    {
        if(false === $this->hasApplication($application)) {
            
            // Push the application at the end of the array
            array_push($this->applications, $application);
        }
    }

    /**
     * @param string $application
     * 
     * Remove the reference to an application
     */
    public function removeApplication($application)
    {
        if(true === $this->hasApplication($application)) {

            // Find the key
            $key = array_search($application, $this->applications);
            
            // Remove it
            unset($this->applications[$key]);
        }
    }

    /**
     * @return boolean 
     */
    public function equals(Team $team)
    {
        if($this->getId()->getValue() !== $team->getId()->getValue()) {
            return false;
        }

        return true;
    }

    /**
     * 
     * Getters for the team
     * 
     */

    /**
     * @return TeamId 
     */
    public function getId()
    {
        if(true === is_string($this->id))
        {
            return new TeamId($this->id);
        }

        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string
     * 
     * @return string
     */
    public function getRole($role)
    {
        return self::getRoleDefinition($this->getId(), $role);
    }

    /**
     * The list of allowed Roles
     * 
     * @var array 
     */
    public static function getAllowedRoles()
    {
        return array(
            'ADMIN' => 'ADMIN',
            'USER'  => 'USER',
            'OWNER' => 'OWNER'
        );
    }

    /**
     * @param TeamId $teamId
     * @param string $role
     * 
     * @return string
     */
    public static function getRoleDefinition(TeamId $teamId, $role)
    {
        if(true === in_array($role, self::getAllowedRoles(), true)) {

            return strtoupper(
                sprintf('ROLE_%s_%s', $role, $teamId)
            );
        }

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return (boolean) $this->locked;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return (boolean) $this->public;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param string $user
     * 
     * @return boolean
     */
    public function hasUser($user)
    {
        return in_array($user, $this->users, true);
    }

    /**
     * @return array
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * @param string $application
     * 
     * @return boolean
     */
    public function hasApplication($application)
    {
        return in_array($application, $this->applications, true);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
