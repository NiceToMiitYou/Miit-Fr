<?php

namespace DomainDrivenDesign\Domain\DomainEvent;

/**
 * Interface DomainEventHandler
 * 
 * The handler of the domain event.
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface DomainEventHandler
{
    /**
     * This method should throw an Exception on failure.
     * 
     * @param DomainEvent    $domainEvent
     */
    public function handle(DomainEvent $domainEvent);
}
