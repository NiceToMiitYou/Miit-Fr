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
     * @Assert\Choice(callback = {"Miit\CoreDomain\Team\Team", "getAllowedRoles"}, multiple = true)
     */
    public $roles;
}