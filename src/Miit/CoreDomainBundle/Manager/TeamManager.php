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
     * @var EmailManager
     */
    private $emailManager;

    /**
     * @param Logger              $logger
     * @param CommandBusInterface $commandBus
     * @param TeamRepository      $teamRepository
     */
    public function __construct(
        Logger              $logger,
        CommandBusInterface $commandBus,
        TeamRepository      $teamRepository
    ) {
        $this->logger         = $logger;
        $this->commandBus     = $commandBus;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param EmailManager $emailManager
     */
    public function setEmailManager(EmailManager $emailManager)
    {
        $this->emailManager = $emailManager;
    }

    /**
     * @param string $name
     * 
     * @return string
     */
    public function slugOf($name)
    {
        $slugify = new Slugify();
        return $slugify->slugify($name);
    }

    /**
     * @param string $name
     * 
     * @return TeamId
     */
    public function createTeam($name)
    {
        $teamId  = TeamId::newInstance();
        $slug    = $this->slugOf($name);

        $command = new CreateTeamCommand($teamId, $slug, $name);

        try {
            $this->commandBus->dispatch($command);
            $this->emailManager->add('team_name', $name);
            $this->emailManager->add('team_slug', $slug);
        } catch (\Exception $exception) {

            $this->logger->crit('The team could not be created.', array(
                'team_id' => sprintf('%s', $teamId),
                'name'    => $name,
                'slug'    => $slug,
                'error'   => sprintf('%s', $exception),
            ));

            $teamId = null;
        }

        return $teamId;
    }

    /**
     * @param Team
     */
    public function setCurrentTeam(TeamModel $team)
    {
        $this->emailManager->add('team_name', $team->getName());
        $this->emailManager->add('team_slug', $team->getSlug());
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