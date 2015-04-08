<?php

namespace Miit\CoreDomain\Team\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Team\TeamId;

/**
 * Class CreateTeamCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class CreateTeamCommand implements Command
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var string
     */
    private $slug;
    
    /**
     * @var string
     */
    private $name;

    /**
     * @param TeamId $teamId
     * @param string $slug
     * @param string $name
     */
    public function __construct(TeamId $teamId, $slug, $name)
    {
        $this->teamId = $teamId;
        $this->slug   = (string) $slug;
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
