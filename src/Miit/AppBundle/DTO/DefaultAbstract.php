<?php

namespace Miit\AppBundle\DTO;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class DefaultAbstract
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class DefaultAbstract
{
    /**
     * @var boolean
     * @Serializer\Type("boolean")
     * @Serializer\Groups({"default"})
     */
    public $done;

    /**
     * @var array
     * @Serializer\Type("array")
     * @Serializer\Groups({"default"})
     */
    public $errors;

    /**
     * Constructor of the Default DTO
     */
    public function __construct()
    {
        $this->done = false;
        $this->errors = array();
    }
}