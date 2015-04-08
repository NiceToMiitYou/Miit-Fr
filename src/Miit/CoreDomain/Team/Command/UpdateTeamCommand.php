<?php

namespace Miit\CoreDomain\Team\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Team\TeamId;

/**
 * Class UpdateTeamCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class UpdateTeamCommand implements Command
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var string
     */
    private $name;

    /**
     * @param TeamId $teamId
     * @param string $name
     */
    public function __construct(TeamId $teamId, $name)
    {
        $this->teamId = $teamId;
        $this->name   = (string) $name;
    }

    /**
     * @return TeamId
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
