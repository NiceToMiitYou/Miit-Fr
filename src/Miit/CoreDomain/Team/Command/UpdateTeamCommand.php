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
     * @var boolean
     */
    private $public;

    /**
     * @param TeamId $teamId
     * @param string $name
     */
    public function __construct(TeamId $teamId, $name, $public)
    {
        $this->teamId = $teamId;
        $this->name   = (string)  $name;
        $this->public = (boolean) $public;
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

    /**
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }
}
