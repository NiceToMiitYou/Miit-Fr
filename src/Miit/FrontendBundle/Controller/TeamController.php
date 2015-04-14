<?php

namespace Miit\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
        $team = $this->get('team_manager')->getTeam();

        if (false === $this->get('security.authorization_checker')->isGranted('user', $team)) {
            $url = $this->generateUrl('welcome_login');

            return new RedirectResponse($url);
        }

        return $this->render('MiitFrontendBundle:team:index.html.twig', array(
            'team_name' => $team->getName()
        ));
    }
}
