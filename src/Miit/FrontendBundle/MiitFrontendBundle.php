<?php

namespace Miit\FrontendBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Implements the frontend
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitFrontendBundle extends Bundle
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
