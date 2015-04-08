<?php

namespace DomainDrivenDesign\Domain\DomainEvent;

/**
 * Interface DomainEventBus
 * 
 * The dispatcher system of all domain events.
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface DomainEventBus
{
    /**
     * This method should be used to dispatch an event to
     * the handler.
     * 
     * @param DomainEvent $domainEvent
     */
    public function dispatch(DomainEvent $domainEvent);
}
