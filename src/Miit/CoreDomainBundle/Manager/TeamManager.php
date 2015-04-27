<?php

namespace Miit\CoreDomainBundle\Manager;

use DomainDrivenDesign\Domain\Command\CommandBus as CommandBusInterface;

use Miit\CoreDomainBundle\Repository\TeamRepository;
use Miit\CoreDomain\Team\Team as TeamModel;
use Miit\CoreDomain\Team\TeamId;
use Miit\CoreDomain\Team\Command\CreateTeamCommand;

use Monolog\Logger;

use Cocur\Slugify\Slugify;

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
     * @var Logger
     */
    private $logger;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * @param TeamRepository $teamRepository
     */
    public function __construct(Logger $logger, CommandBusInterface $commandBus, TeamRepository $teamRepository)
    {
        $this->logger         = $logger;
        $this->commandBus     = $commandBus;
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