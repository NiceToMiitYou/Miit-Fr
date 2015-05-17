<?php

namespace Miit\ApiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Implements the api in Symfony
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitApiBundle extends Bundle
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
