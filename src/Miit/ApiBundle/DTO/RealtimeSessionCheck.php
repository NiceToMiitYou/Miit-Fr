<?php

namespace Miit\ApiBundle\DTO;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RealtimeSessionCheck
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class RealtimeSessionCheck extends DefaultAbstract
{
    /**
     * @var string
     * @Serializer\Groups({"default"})
     */
    public $type;

    /**
     * @var User
     * @Serializer\Groups({"default"})
     */
    public $user;

    /**
     * Constructor of the Default DTO
     */
    public function __construct()
    {
        parent::__construct();
        $this->type = 'SESSION_UNDEFINED';
    }
}