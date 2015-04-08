<?php

namespace Miit\CoreDomainBundle\Manager;

use Miit\CoreDomainBundle\Repository\TeamRepository;
use Miit\CoreDomain\Team\Team as TeamModel;

/**
 * Class TeamManager
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamManager
{
    /**
     * @var Team
     */
    private $team;

    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param Team
     */
    public function setCurrentTeam(TeamModel $team)
    {
        $this->team = $team;
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}