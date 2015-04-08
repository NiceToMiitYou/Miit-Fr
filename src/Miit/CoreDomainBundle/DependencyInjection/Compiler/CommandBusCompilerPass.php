<?php

namespace Miit\CoreDomainBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CommandBusCompilerPass
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class CommandBusCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('command_bus')) {
            return;
        }

        $definition = $container->getDefinition(
            'command_bus'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'command_bus.register'
        );
        
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'register',
                array(new Reference($id))
            );
        }
    }
}