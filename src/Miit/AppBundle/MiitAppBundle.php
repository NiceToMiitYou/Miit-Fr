<?php

namespace Miit\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Implements the app system
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitAppBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return __DIR__;
    }
}
