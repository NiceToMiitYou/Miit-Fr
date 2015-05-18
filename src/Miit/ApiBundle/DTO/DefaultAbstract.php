<?php

namespace Miit\ApiBundle\DTO;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class DefaultAbstract
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class DefaultAbstract
{
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
        $this->errors = array();
    }
}