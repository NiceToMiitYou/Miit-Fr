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

    /**
     * @Assert\NotBlank(
     *      groups={"change_password"}
     * )
     * @Assert\Length(
     *      groups={"change_password"},
     *      min=6
     * )
     */
    public $password;
}