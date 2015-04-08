<?php

namespace Miit\CoreDomainBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class MiitCoreDomainExtension
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitCoreDomainExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container) {
        
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(array(__DIR__.'/../Resources/config'))
        );

        // Load all factories
        $loader->load('factories.xml');
        
        // Load all repositories
        $loader->load('repositories.xml');
        
        // Load the managers
        $loader->load('managers.xml');

        // Load the managers
        $loader->load('event_listeners.xml');

        // Load all user command handlers
        $loader->load('user_command_handlers.xml');

        // Load all team command handlers
        $loader->load('team_command_handlers.xml');

        // Load the command bus
        $loader->load('command_bus.xml');
    }

    public function getXsdValidationBasePath() {
        return null;
    }

    public function getNamespace() {
        return 'http://www.symfony-project.org/schema/dic/symfony';
    }
    
    public function getAlias() {
        return 'miit_core_domain';
    }
}
