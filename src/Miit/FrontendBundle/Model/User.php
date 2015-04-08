<?php

namespace Miit\FrontendBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class User
{
    /**
     * @Assert\Length(
     *      min = "4",
     *      max = "24",
     *      groups={"registration"}
     * )
     */
    public $username;

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
     * @Assert\Length(
     *      min = "6",
     *      max = "48",
     *      groups={"registration"}
     * )
     */
    public $password;
}