<?php

namespace Miit\CoreDomain\Miit;

use DomainDrivenDesign\Domain\Model\Entity;

/**
 * Class Miit
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class Miit implements Entity
{
    /**
     * The unique id of the team
     * 
     * @var MiitId 
     */
    protected $id;

    /**
     * The token of the miit
     * 
     * @var string
     */
    protected $token;

    /**
     * The name of the team
     * 
     * @var string
     */
    protected $name;

    /**
     * Define if the team is locked
     * 
     * @var MiitStateEnum
     */
    protected $state;

    /**
     * The team of the miit
     * 
     * @var Team
     */
    protected $team;

    /**
     * Define if the miit is public
     * 
     * @var boolean
     */
    protected $public;

    /**
     * The list of users
     * 
     * @var array
     */
    protected $users;

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
     * @param string $token
     * @param string $name
     * @param mixed  $team
     */
    public function __construct(MiitId $id, $token, $name, $team, $public = false)
    {
        $this->id     = $id;
        $this->token  = (string) $slug;
        $this->name   = (string) $name;
        $this->team   = $team;
        $this->public = $public;
        $this->state  = MiitStateEnum::UnderConstruction;
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
    public function update($name, $state, $public)
    {
        $this->state     = $state;
        $this->name      = $name;
        $this->public    =
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
     * @return boolean 
     */
    public function equals(Miit $miit)
    {
        if($this->getId()->getValue() !== $miit->getId()->getValue()) {
            return false;
        }

        return true;
    }

    /**
     * 
     * Getters for the Miit
     * 
     */

    /**
     * @return MiitId 
     */
    public function getId()
    {
        if(true === is_string($this->id))
        {
            return new MiitId($this->id);
        }

        return $this->id;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return MiitStateEnum
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return (boolean) $this->public;
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
