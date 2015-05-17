<?php

namespace Miit\CoreDomain\Team\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Team\TeamId;

/**
 * Class AddApplicationTeamCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class AddApplicationTeamCommand implements Command
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var array
     */
    private $applications;

    /**
     * @param TeamId $teamId
     * @param array  $applications
     */
    public function __construct(TeamId $teamId, $applications)
    {
        $this->teamId = $teamId;

        if(is_array($applications)) {
            $this->applications = $applications;
        } else {
            $this->applications = array($applications);
        }
    }

    /**
     * @return TeamId
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @return array
     */
    public function getApplications()
    {
        return $this->applications;
    }
}
