<?php

namespace Miit\CoreDomainBundle\AnnotationDriver;

use Miit\CoreDomainBundle\Annotation\Permissions;

use Doctrine\Common\Annotations\Reader;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AnnotationDriver
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class AnnotationDriver
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var TeamManager
     */
    private $teamManager;

    /**
     * @param Reader      $reader
     * @param TeamManager $teamManager
     */
    public function __construct($reader, $teamManager)
    {
        $this->reader      = $reader;
        $this->teamManager = $teamManager;
    }
    
    /**
     * This event will fire during any controller call
     * 
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) { 
            return; //return if no controller
        }

        $controllerObject = $controller[0];
        $controllerMethod = $controller[1];

        $object = new \ReflectionObject($controllerObject);
        $method = $object->getMethod($controllerMethod);

        $annotations = $this->reader->getMethodAnnotations($method);

        foreach($annotations as $configuration)
        {
            //Found our annotation
            if($configuration instanceof Permissions)
            {
                $role     = $configuration->perm;
                $redirect = $configuration->redirect;
                $strict   = $configuration->strict;
                $team     = $this->teamManager->getTeam();
                $checker  = $controllerObject->get('security.authorization_checker');

                $attributes = array(
                    'role'   => $role,
                    'strict' => $strict
                );

                if (false === $checker->isGranted($attributes, $team))
                {
                    if($redirect)
                    {
                        $url = $controllerObject->generateUrl('team_login', array(
                            'team_slug' => $team->getSlug()
                        ));

                        return $event->setController(function() use ($url) {
                            return new RedirectResponse($url);
                        });
                    }
                    else
                    {
                        throw new AccessDeniedHttpException();
                    }
                }
             }
         }
    }
}