<?php

namespace Miit\CoreDomainBundle\CommandBus;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandBus as CommandBusInterface;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;


/**
 * Class CommandBus
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class CommandBus implements CommandBusInterface
{
    /**
     * @var array
     */
    private $handlers = array();

    /**
     * Register an handler to the Bus
     */
    public function register($service)
    {
        $commandName = $service->supportedCommand();

        if(false === array_key_exists($commandName, $this->handlers)) {

            $this->handlers[$commandName] = $service;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(Command $command)
    {
        $reflection = new \ReflectionClass($command);

        // Check for the Handler
        if(true === array_key_exists($reflection->getName(), $this->handlers)) {

            // Get the handler
            $handler = $this->handlers[$reflection->getName()];

            // Send the command the right handler
            $handler->handle($command);
        } else {

            throw new CommandNotSupportedByHandler($this, $command);   
        }
    }
}
