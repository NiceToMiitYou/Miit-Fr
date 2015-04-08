<?php

namespace DomainDrivenDesign\Domain\Model;

/**
 * Interface Aggregate
 * 
 * A collection of objects that are bound together by a root
 * entity, otherwise known as an aggregate root.
 * 
 * The aggregate root guarantees the consistency of changes
 * being made within the aggregate by forbidding external
 * objects from holding references to its members.
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface Aggregate
{

}
