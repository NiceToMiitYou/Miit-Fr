<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\Common\UUID;
use Miit\CoreDomain\Common\Email;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\NewsLetterRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class NewsLetter
{
    /**
     * @var string The namespace of the UUID
     */
    const NEWSLETTER_NAMESPACE = '6ed05e72-0ccc-3ef2-69db-1b38201da8b8';

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $subscribed;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $removed;

    /**
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->id = UUID::v5(
            NewsLetter::NEWSLETTER_NAMESPACE,
            UUID::v4()
        );
        $this->email      = $email;
        $this->subscribed = true;
        $this->removed    = false;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return boolean
     */
    public function hasSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * @return boolean
     */
    public function isRemoved()
    {
        return $this->removed;
    }
}
