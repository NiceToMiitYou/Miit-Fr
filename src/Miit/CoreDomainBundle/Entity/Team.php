<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\Team\Team as TeamModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Team
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\TeamRepository")
 */
class Team extends TeamModel
{
    /**
     * {@inheritDoc}
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $id;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    protected $slug;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * The list of users which they have subscribe
     * 
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $locked;

    /**
     * {@inheritDoc}
     * 
     * @ORM\ManyToMany(targetEntity="User", mappedBy="teams")
     * 
     */
    protected $users;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
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
}