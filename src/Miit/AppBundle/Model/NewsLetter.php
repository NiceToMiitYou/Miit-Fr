<?php

namespace Miit\AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NewsLetter
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class NewsLetter
{
    /**
     * @Assert\NotBlank(
     *      groups={"news_letter"}
     * )
     * @Assert\Email(
     *      groups={"news_letter"}
     * )
     */
    public $email;

}