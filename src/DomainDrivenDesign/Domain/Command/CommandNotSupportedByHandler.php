<?php

namespace DomainDrivenDesign\Domain\Command;

/**
 * Exception CommandNotSupportedByHandler
 * 
 * Throw when the Handler doesn't support the DomainEvent
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class CommandNotSupportedByHandler extends \Exception
{
    /**
     * @param object $handler
     * @param object $command
     */
    public function __construct($handler, $command) {

        $reflectionCommand = new \ReflectionClass($command);
        $reflectionHandler = new \ReflectionClass($handler);

        $message = sprintf(
            'The command "%s" is not supported by "%s"',
            $reflectionCommand->getName(),
            $reflectionHandler->getName()
        );

        parent::__construct($message);
    }
}
