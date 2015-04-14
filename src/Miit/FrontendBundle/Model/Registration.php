<?php

namespace Miit\FrontendBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Registration
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class Registration
{
    /**
     * @Assert\Type(
     *      type="Miit\FrontendBundle\Model\User",
     *      groups={"registration"}
     * )
     */
    public $user;

    /**
     * @Assert\Type(
     *      type="Miit\FrontendBundle\Model\Team",
     *      groups={"registration"}
     * )
     */
    public $team;

    /**
     * @Assert\NotBlank(
     *      groups={"registration"}
     * )
     * @Assert\True(
     *      groups={"registration"}
     * )
     */
    public $termsAccepted;
}