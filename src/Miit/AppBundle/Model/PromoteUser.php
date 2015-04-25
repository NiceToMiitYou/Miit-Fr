<?php

namespace Miit\AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PromoteUser
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class PromoteUser
{   
    /**
     * @Assert\Choice(choices = {"USER", "ADMIN"}, multiple = true)
     */
    public $roles;
}