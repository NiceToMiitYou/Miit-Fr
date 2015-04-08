<?php

namespace DomainDrivenDesign\Domain\Command;

/**
 * Interface CommandHandler
 * 
 * The handler of the command.
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface CommandHandler
{
    /**
     * This method should throw an Exception on failure.
     * 
     * @param Command    $command
     */
    public function handle(Command $command);

    /**
     * The supported command.
     * 
     * @return string
     */
    public function supportedCommand();
}
