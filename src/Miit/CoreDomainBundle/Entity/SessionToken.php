<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\Common\UUID;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\SessionTokenRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class SessionToken
{
    /**
     * @var string The namespace of the UUID
     */
    const SESSION_TOKEN_NAMESPACE = '321b8d58-5671-5c35-c388-93eb46db5b2f';

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     */
    protected $team;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expire;

    /**
     * @param User $user
     */
    public function __construct(User $user, Team $team)
    {
        // Generate the UUID (v3 to know that is a SessionToken)
        $this->id     = UUID::v3(
            SessionToken::SESSION_TOKEN_NAMESPACE,
            UUID::v4()
        );
        $this->user   = $user;
        $this->team   = $team;
        $this->expire = new \DateTime('+4 hours');
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return new \Datetime() < $this->expire;
    }
}
