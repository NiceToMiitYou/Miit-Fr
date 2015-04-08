<?php

namespace DomainDrivenDesign\Domain\Command;

/**
 * Interface CommandBus
 * 
 * The dispatcher system of all commands.
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface CommandBus
{
    /**
     * This method should be used to dispatch a command to 
     * the handler.
     * 
     * @param Command $command
     */
    public function dispatch(Command $command);
}
