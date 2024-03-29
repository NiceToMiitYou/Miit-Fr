<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\Team\Team as TeamModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Team
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\TeamRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Team extends TeamModel
{
    /**
     * {@inheritDoc}
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=255, nullable=false)
     * 
     * @Serializer\Groups({"list", "details"})
     */
    protected $id;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     * 
     * @Serializer\Groups({"list", "details"})
     */
    protected $slug;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false)
     * 
     * @Serializer\Groups({"list", "details"})
     */
    protected $name;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="boolean", nullable=false)
     * 
     * @Serializer\Groups({"details"})
     */
    protected $locked;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="boolean", nullable=false)
     * 
     * @Serializer\Groups({"list", "details"})
     */
    protected $public;

    /**
     * {@inheritDoc}
     * 
     * @ORM\ManyToMany(targetEntity="User", mappedBy="teams")
     */
    protected $users;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="array", nullable=true)
     * 
     * @Serializer\Groups({"details"})
     */
    protected $applications;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @Serializer\Groups({"details"})
     */
    protected $createdAt;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * {@inheritDoc}
     */
    public function __construct($id, $slug, $name)
    {
        parent::__construct($id, $slug, $name);

        $this->users = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function addUser($user)
    {
        if(false === $this->hasUser($user)) {
            
            // Push the user at the end of the array
            $this->users->add($user);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removeUser($user)
    {
        if(true === $this->hasUser($user)) {

            // Remove it
            $this->users->removeElement($user);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function hasUser($user)
    {
        return $this->users->contains($user);
    }
}