<?php

namespace Miit\FrontendBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class MiitFrontendExtension
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitFrontendExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container) {
        
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(array(__DIR__.'/../Resources/config'))
        );

        // Load all factories
        $loader->load('forms.xml');
        
    }

    public function getXsdValidationBasePath() {
        return null;
    }

    public function getNamespace() {
        return 'http://www.symfony-project.org/schema/dic/symfony';
    }
    
    public function getAlias() {
        return 'miit_frontend';
    }
}
