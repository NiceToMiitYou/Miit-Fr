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
     * Define if the team is locked
     * 
     * @var boolean
     */
    protected $locked;

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
        $this->id     = $id;
        $this->slug   = (string) $slug;
        $this->name   = (string) $name;
        $this->locked = false;
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
    public function update($name)
    {
        $this->name      = $name;
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
     * @return boolean 
     */
    public function equals(Team $team)
    {
        if($this->id->getValue() !== $team->getId()->getValue()) {
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
