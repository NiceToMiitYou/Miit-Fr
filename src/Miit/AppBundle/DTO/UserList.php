<?php

namespace Miit\AppBundle\DTO;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class UserList
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserList extends DefaultAbstract
{
    /**
     * @var array
     * @Serializer\Groups({"default"})
     */
    public $users;
}