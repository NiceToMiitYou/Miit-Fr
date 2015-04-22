<?php

namespace Miit\CoreDomain\Team\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Team\TeamId;

/**
 * Class AddUserTeamCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class AddUserTeamCommand implements Command
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var array
     */
    private $users;

    /**
     * @param TeamId $teamId
     * @param array  $users
     */
    public function __construct(TeamId $teamId, $users)
    {
        $this->teamId = $teamId;
        $this->users  = $users;
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
    public function getUsers()
    {
        return $this->users;
    }
}
