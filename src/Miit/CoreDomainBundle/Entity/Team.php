<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\Team\Team as TeamModel;

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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $slug;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $locked;

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
}