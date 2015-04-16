<?php

namespace MiitApps\QuizzBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Implements the quizz app
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitAppsQuizzBundle extends Bundle
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
