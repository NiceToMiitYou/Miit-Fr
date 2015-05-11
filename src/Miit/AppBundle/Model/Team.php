<?php

namespace Miit\AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Team
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class Team
{
    /**
     * @Assert\NotBlank(
     *      groups={"registration", "update"}
     * )
     * @Assert\Length(
     *      min=4,
     *      max=32
     * )
     */
    public $name;

    /**
     * @Assert\Type(
     *      type="bool",
     *      groups={"update"}
     * )
     */
    public $public;
}