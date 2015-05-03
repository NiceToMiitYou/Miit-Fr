<?php

namespace Miit\CoreDomain\Miit\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandHandler;

use Miit\CoreDomain\Miit\MiitFactory;
use Miit\CoreDomain\Miit\MiitRepository;

/**
 * Class MiitCommandHandlerAbstract
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class MiitCommandHandlerAbstract implements CommandHandler
{
    /**
     * @var MiitFactory
     */
    protected $miitFactory;

    /**
     * @var MiitRepository
     */
    protected $miitRepository;

    /**
     * @param MiitFactory    $miitFactory
     * @param MiitRepository $miitRepository
     */
    public function __construct(MiitFactory $miitFactory, MiitRepository $miitRepository)
    {
        $this->miitFactory    = $miitFactory;
        $this->miitRepository = $miitRepository;
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
