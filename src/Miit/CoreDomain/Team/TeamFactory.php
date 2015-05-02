<?php

namespace Miit\CoreDomain\Team;

use DomainDrivenDesign\Domain\Model\Factory;

/**
 * Interface TeamFactory
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface TeamFactory extends Factory
{
    /**
     * Return a new instance of team
     * 
     * @param TeamId $teamId
     * @param string $slug
     * @param string $name
     * 
     * @return Team
     */
    public function newIntance(TeamId $teamId, $slug, $name);
}
