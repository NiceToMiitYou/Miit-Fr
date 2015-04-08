<?php

namespace Miit\CoreDomainBundle\Factory;

use Miit\CoreDomain\Team\TeamId;
use Miit\CoreDomain\Team\TeamFactory as TeamFactoryInterface;

use Miit\CoreDomainBundle\Entity\Team;

/**
 * Class TeamFactory
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamFactory implements TeamFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function newIntance(TeamId $teamId, $slug, $name)
    {
        return new Team($teamId, $slug, $name);
    }
}
