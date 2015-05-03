<?php

namespace Miit\CoreDomain\Miit;

use Miit\CoreDomain\Common\BasicEnum;

/**
 * Class MiitState
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class MiitStateEnum extends BasicEnum
{
    /**
     * The miit is closed
     */
    const UnderConstruction = 0;

    /**
     * The miit is ready to be opened
     */
    const Ready = 1;

    /**
     * The miit is opened
     */
    const Opened = 2;

    /**
     * The miit is closed
     */
    const Closed = 4;

    /**
     * The miit is deleted
     */
    const Deleted = 8;
}
