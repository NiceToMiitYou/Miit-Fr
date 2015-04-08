<?php

namespace DomainDrivenDesign\Domain\DomainEvent;

/**
 * Exception DomainEventNotSupportedByHandler
 * 
 * Throw when the Handler doesn't support the DomainEvent
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class DomainEventNotSupportedByHandler extends \Exception
{
    /**
     * @param object $handler
     * @param object $event
     */
    public function __construct($handler, $event) {

        $reflectionEvent   = new \ReflectionClass($event);
        $reflectionHandler = new \ReflectionClass($handler);

        $message = sprintf(
            'The domain event "%s" is not supported by "%s"',
            $reflectionEvent->getName(),
            $reflectionHandler->getName()
        );

        parent::__construct($message);
    }
}
