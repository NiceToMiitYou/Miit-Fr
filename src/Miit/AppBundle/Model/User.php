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
    public $password_old;

    /**
     * @Assert\NotBlank(
     *      groups={"change_password"}
     * )
     * @Assert\Length(
     *      groups={"change_password"},
     *      min=6
     * )
     */
    public $password_new;

    /**
     * @Assert\Choice(
     *      groups={"promote_user", "demote_user"},
     *      callback = {"Miit\CoreDomain\Team\Team", "getAllowedRoles"},
     *      multiple = true
     * )
     */
    public $roles;
}