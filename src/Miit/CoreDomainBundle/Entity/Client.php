<?php

namespace Miit\CoreDomainBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
}