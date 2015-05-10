<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\Miit\Miit as MiitModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Miit
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\MiitRepository")
 * @ORM\Table(name="Miit", indexes= {
 *      @ORM\Index(name="token_idx", columns={"token"})
 * })
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Miit extends MiitModel
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
     * @ORM\Column(type="string", length=255, nullable=false)
     * 
     * @Serializer\Groups({"list", "details"})
     */
    protected $token;

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
     * @ORM\Column(type="integer", nullable=false)
     * 
     * @Serializer\Groups({"list", "details"})
     */
    protected $state;

    /**
     * {@inheritDoc}
     * 
     * @ORM\ManyToMany(targetEntity="User", mappedBy="miits")
     */
    protected $users;

    /**
     * {@inheritDoc}
     * 
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="miits")
     */
    protected $team;

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
     * 
     * @Serializer\Groups({"details"})
     */
    protected $updatedAt;

    /**
     * {@inheritDoc}
     */
    public function __construct($id, $token, $name, $team, $public)
    {
        parent::__construct($id, $token, $name, $team, $public);

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