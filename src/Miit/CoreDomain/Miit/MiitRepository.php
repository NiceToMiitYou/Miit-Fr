<?php

namespace Miit\CoreDomain\Miit;

use Miit\CoreDomain\Team\TeamId;

use DomainDrivenDesign\Domain\Model\Repository;

/**
 * Interface MiitRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface MiitRepository extends Repository
{
    /**
     * Return the miit based on his id
     * 
     * @param MiitId $miitId
     * 
     * @return Miit
     */
    public function findMiitByMiitId(MiitId $miitId);

    /**
     * Return the miit based on his token and team id
     * 
     * @param TeamId $teamId
     * @param string $token
     * 
     * @return Miit
     */
    public function findMiitByTeamAndToken(TeamId $teamId, $token);

    /**
     * Persist the given User
     * 
     * @param Miit $miit
     */
    public function persist(Miit $miit);
}
