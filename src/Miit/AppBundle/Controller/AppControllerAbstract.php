<?php

namespace Miit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AppController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class AppControllerAbstract extends Controller
{
    /**
     * @param string  $formName
     * @param Request $request
     * 
     * @return FormInterface
     */
    protected function validateForm($formName, Request $request)
    {
        $form = $this->createForm($formName);
        $data = @json_decode($request->getContent(), true);

        $form->submit($data);

        return $form ;
    }

    /**
     * Throw a not found Exception on invalid role
     * 
     * @param string $role
     */
    protected function checkRole($role)
    {
        $team = $this->getTeam();

        if (false === $this->get('security.authorization_checker')->isGranted($role, $team)) {
            throw new NotFoundHttpException();
        }
    }

    /**
     * @return Team
     */
    protected function getTeam()
    {
        return $this->get('team_manager')->getTeam();
    }

    /**
     * @return array
     */
    protected function getDefaultResponse()
    {
        return array(
            'done' => false
        );
    }
}
