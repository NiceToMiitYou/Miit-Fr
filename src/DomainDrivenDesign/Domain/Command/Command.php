<?php

namespace DomainDrivenDesign\Domain\Command;

/**
 * Interface Command
 * 
 * People request changes to the domain by sending commands.
 * 
 * They are named with a verb in the imperative mood plus
 * and may include the aggregate type.
 * 
 * Unlike an event, a command is not a statement of fact;
 * it's only a request, and thus may be refused. (A typical
 * way to convey refusal is to throw an exception).
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface Command
{

}
