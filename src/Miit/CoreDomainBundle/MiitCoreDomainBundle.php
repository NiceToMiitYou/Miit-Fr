<?php

namespace Miit\CoreDomainBundle;

use Miit\CoreDomainBundle\DependencyInjection\Compiler\CommandBusCompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Implements the core domain in Symfony
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitCoreDomainBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass);
    }
    
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
