<?php

namespace Miit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AppController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class AppControllerAbstract extends Controller
{
    /**
     * Throw a not found Exception on invalid role
     * 
     * @param string $role
     */
    protected function checkRole($role)
    {
        $team = $this->get('team_manager')->getTeam();

        if (false === $this->get('security.authorization_checker')->isGranted($role, $team)) {
            throw new NotFoundHttpException();
        }
    }
}
