<?php

namespace Miit\CoreDomainBundle\Annotation;

/**
 * Class Permissions
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @Annotation
 */
class Permissions
{
    /**
     * @var string
     */
    public $perm;

    /**
     * @var boolean
     */
    public $redirect = false;
}