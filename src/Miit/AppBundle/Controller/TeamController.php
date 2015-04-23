<?php

namespace Miit\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use JMS\Serializer\SerializationContext;

class TeamController extends Controller
{
    /**
     * @Route("/team/users",
     *      host="{team_slug}.{domain}",
     *      name="app_team_users",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "GET",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     */
    public function listUsersAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');

        $response = new JsonResponse();

        $team     = $this->get('team_manager')->getTeam();
        $users    = $this->get('user_repository')->findUsersByTeam($team);

        $context  = SerializationContext::create()->setGroups(array('list'));
        $data     = $serializer->serialize($users, 'json', $context);

        $response->setContent($data);

        return $response;
    }
}
