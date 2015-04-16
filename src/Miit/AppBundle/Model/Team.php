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
     *      groups={"registration"}
     * )
     * @Assert\Length(
     *      min=4,
     *      min=32
     * )
     */
    public $name;
}