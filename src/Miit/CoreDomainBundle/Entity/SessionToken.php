<?php

namespace Miit\CoreDomainBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SessionToken extends BaseRefreshToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;
}
