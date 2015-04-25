<?php

namespace Miit\AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DemoteUser
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class DemoteUser
{   
    /**
     * @Assert\Choice(choices = {"USER", "ADMIN"}, multiple = true)
     */
    public $roles;
}