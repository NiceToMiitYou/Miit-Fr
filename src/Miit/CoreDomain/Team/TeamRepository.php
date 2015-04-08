<?php

namespace Miit\CoreDomain\Team;

use DomainDrivenDesign\Domain\Model\Repository;

/**
 * Interface TeamRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface TeamRepository extends Repository
{
    /**
     * Return the team based on his id
     * 
     * @param TeamId $teamId
     * 
     * @return Team
     */
    public function findTeamByTeamId(TeamId $teamId);

    /**
     * Return the team based on his slug
     * 
     * @param string $slug
     * 
     * @return Team
     */
    public function findTeamBySlug($slug);

    /**
     * Persist the given User
     * 
     * @param Team $team
     */
    public function persist(Team $team);
}
