<?php

namespace Miit\AppBundle\Model;

use Miit\CoreDomain\Team\Team;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class User
{
    /**
     * @Assert\Regex(
     *      groups={"promote_user", "demote_user", "remove_user"},
     *      pattern="/^[0-9a-f]{8}-[0-9a-f]{4}-5[0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}$/",
     *      match=true
     * )
     */
    public $id;

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
     *      groups={"update"}
     * )
     * @Assert\Regex(
     *      groups={"update"},
     *      pattern="/^[0-9a-zA-Z_\'\-\. ]{4,42}$/",
     *      match=true
     * )
     */
    public $name;

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
     *      callback = "getAllowedRoles",
     *      multiple = true
     * )
     */
    public $roles;

    /**
     * Proxy for the list of roles
     * 
     * @return array
     */
    public static function getAllowedRoles() {
        return Team::getAllowedRoles();
    }

}