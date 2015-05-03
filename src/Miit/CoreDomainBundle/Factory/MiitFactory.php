<?php

namespace Miit\CoreDomainBundle\Factory;

use Miit\CoreDomain\Miit\MiitId;
use Miit\CoreDomain\Miit\MiitFactory as MiitFactoryInterface;

use Miit\CoreDomainBundle\Entity\Miit;

/**
 * Class MiitFactory
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitFactory implements MiitFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function newIntance(MiitId $miitId, $token, $name, $team, $public = false)
    {
        return new Miit($miitId, $token, $name, $team, $public);
    }
}
