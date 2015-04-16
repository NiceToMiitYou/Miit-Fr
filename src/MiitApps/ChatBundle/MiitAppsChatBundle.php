<?php

namespace MiitApps\ChatBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Implements the chat app
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitAppsChatBundle extends Bundle
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
