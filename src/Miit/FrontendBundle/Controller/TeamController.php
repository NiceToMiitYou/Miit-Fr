<?php

namespace Miit\FrontendBundle\Controller;

use Miit\CoreDomainBundle\Annotation\Permissions;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use JMS\Serializer\SerializationContext;

/**
 * Class TeamController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamController extends Controller
{
    /**
     * @Route("/{nothing}",
     *      host="{team_slug}.{domain}",
     *      name="team_home",
     *      defaults={
     *          "domain":    "%domain%",
     *          "nothing":   ""
     *      },
     *      requirements={
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}",
     *          "nothing":   "(?!(login|logout))[a-zA-Z0-9-+_/\s]+"
     *      }
     * )
     * @Permissions(perm="USER", redirect=true)
     */
    public function indexAction(Request $request, $team_slug)
    {
        $team = $this->get('team_manager')->getTeam();
        $user = $this->getUser();

        if(null === $user && $team->isPublic()) {
            $token = $this->get('security.context')->getToken();
            $user  = array(
                'id'    => 'none',
                'name'  => 'Anonyme',
                'roles' => array('ANONYM')
            );
        }

        $user_context = SerializationContext::create()->setGroups(array('owner'));
        $team_context = SerializationContext::create()->setGroups(array('details'));

        return $this->render('MiitFrontendBundle:team:index.html.twig', array(
            'team_name'    => $team->getName(),
            'user_context' => $user_context,
            'user'         => $user,
            'team_context' => $team_context,
            'team'         => $team
        ));
    }

    /**
     * @Route("/login",
     *      name="team_login",
     *      host="{team_slug}.{domain}",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     */
    public function loginAction(Request $request)
    {
        $team    = $this->get('team_manager')->getTeam();

        $helper = $this->get('security.authentication_utils');
 
        return $this->render('MiitFrontendBundle:team:login.html.twig', array(
            'last_username' => $helper->getLastUsername(),
            'error'         => $helper->getLastAuthenticationError(),
            'team_name'     => $team->getName(),
            'team_public'   => $team->isPublic()
        ));
    }
}
