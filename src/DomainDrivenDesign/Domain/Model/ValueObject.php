<?php

namespace DomainDrivenDesign\Domain\Model;

/**
 * Interface ValueObject
 * 
 * An object that contains attributes but has no conceptual
 * identity. 
 * 
 * They should be treated as immutable.
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface ValueObject
{
    /**
     * Return the value of the ValueObject
     * 
     * @return mixed
     */
    public function getValue();
}
