<?php

namespace Miit\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use JMS\Serializer\SerializationContext;

/**
 * Class TeamController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamController extends AppControllerAbstract
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
        $this->checkRole('USER');

        $serializer = $this->get('jms_serializer');

        $response   = new JsonResponse();

        $teamId     = $this->getTeam()->getId();
        $users      = $this->get('user_repository')->findUsersByTeam($teamId);

        $context    = SerializationContext::create()->setGroups(array('list'));
        $data       = $serializer->serialize($users, 'json', $context);

        $response->setContent($data);

        return $response;
    }
}
