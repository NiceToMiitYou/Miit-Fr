<?php

namespace Miit\AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class User
{
    /**
     * @Assert\NotBlank(
     *      groups={"registration"}
     * )
     * @Assert\Email(
     *      groups={"registration"}
     * )
     */
    public $email;
}