<?php

namespace Miit\CoreDomain\Team\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Team\TeamId;

/**
 * Class LockTeamCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class LockTeamCommand implements Command
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @param TeamId $teamId
     */
    public function __construct(TeamId $teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * @return TeamId
     */
    public function getTeamId()
    {
        return $this->teamId;
    }
}
