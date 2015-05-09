<?php

namespace Miit\AppBundle\DTO;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class UserInvite
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserInvite extends DefaultAbstract
{
    /**
     * @var User
     * @Serializer\Groups({"default"})
     */
    public $user;
}