<?php

namespace Miit\CoreDomainBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;
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

        $configFiles = array(
            'factories.xml',
            'repositories.xml',
            'managers.xml',
            'voters.xml',
            'serializer_subscribers.xml',
            'event_listeners.xml',
            'user_command_handlers.xml',
            'team_command_handlers.xml',
            'miit_command_handlers.xml',
            'command_bus.xml'
        );

        foreach ($configFiles as $configFile) {
            $loader->load($configFile);
        }
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
