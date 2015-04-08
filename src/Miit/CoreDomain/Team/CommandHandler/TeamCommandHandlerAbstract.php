<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandHandler;

use Miit\CoreDomain\Team\TeamFactory;
use Miit\CoreDomain\Team\TeamRepository;

/**
 * Class TeamCommandHandlerAbstract
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class TeamCommandHandlerAbstract implements CommandHandler
{
    /**
     * @var TeamFactory
     */
    protected $teamFactory;

    /**
     * @var TeamRepository
     */
    protected $teamRepository;

    /**
     * @param TeamFactory    $teamFactory
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamFactory $teamFactory, TeamRepository $teamRepository)
    {
        $this->teamFactory    = $teamFactory;
        $this->teamRepository = $teamRepository;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function handle(Command $command);

    /**
     * {@inheritdoc}
     */
    abstract public function supportedCommand();
}
