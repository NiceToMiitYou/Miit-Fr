<?php

namespace Miit\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    /**
     * @Route("/",
     *      host="{team_slug}.{domain}",
     *      name="team_home",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     */
    public function indexAction(Request $request, $team_slug)
    {
        return $this->render('MiitFrontendBundle:team:index.html.twig', array(
            'team_name' => $this->get('team_manager')->getTeam()->getName()
        ));
    }
}
