<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomain\Common\Email;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use JMS\Serializer\SerializationContext;

/**
 * Class TeamController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @Route("/team")
 */
class TeamController extends AppControllerAbstract
{
    /**
     * @Route("/users",
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

    /**
     * @Route("/invite",
     *      host="{team_slug}.{domain}",
     *      name="app_user_invite_user",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "POST",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     */
    public function inviteUserAction(Request $request)
    {
        $this->checkRole('ADMIN');

        $form     = $this->validateForm('user_registration_type', $request);
        $response = $this->getDefaultResponse();

        if ($form->isValid())
        {
            $inviteUser = $form->getData();

            // Get data
            $teamId = $this->getTeam()->getId();
            $email  = new Email($inviteUser->email);

            $userId = $this->get('user_manager')->inviteInTeam($email, $teamId);

            if(null !== $userId) {
                $response['done'] = true;
            }
        }

        return new JsonResponse($response);
    }
}
