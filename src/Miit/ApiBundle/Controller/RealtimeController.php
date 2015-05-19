<?php

namespace Miit\ApiBundle\Controller;

use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\Team\TeamId;

use Miit\ApiBundle\DTO\RealtimeSessionCheck;

use Miit\CoreDomainBundle\Entity\SessionToken;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use JMS\Serializer\SerializationContext;

/**
 * Class RealtimeController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @Route("/realtime")
 */
class RealtimeController extends Controller
{
    /**
     * @Route("/check/{userId}/{teamId}/{token}",
     *      name="api_realtime_check",
     *      requirements={
     *          "userId":  "^[0-9a-f]{8}-[0-9a-f]{4}-[45][0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}$",
     *          "teamId":  "^[0-9a-f]{8}-[0-9a-f]{4}-5[0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}$",
     *          "token":   "^[0-9a-f]{8}-[0-9a-f]{4}-[34][0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}$",
     *          "_method": "GET"
     *      }
     * )
     */
    public function checkAction(Request $request, $userId, $teamId, $token)
    {
        $serializer = $this->get('jms_serializer');

        $response   = new JsonResponse();
        $DTO        = new RealtimeSessionCheck();

        try {
            $teamRepository = $this->get('team_repository');

            $teamId = new TeamId($teamId);
            $team   = $teamRepository->findTeamByTeamId($teamId);

            if(null !== $team)
            {
                $isAnonym = $userId === $token;

                if(true === $isAnonym && true === $team->isPublic())
                {
                    $DTO->type = 'SESSION_ANONYM';
                    $DTO->user = array(
                        'id'    => $userId
                    );
                    $DTO->team = $team;
                }
                else if(false === $isAnonym)
                {
                    $teamManager = $this->get('team_manager');
                    $teamManager->setCurrentTeam($team);

                    $sessionRepository = $this->get('session_token_repository');

                    $userId = new UserId($userId);
                    $token  = $sessionRepository->findSessionTokenByIdAndUserIdAndTeamId($token, $userId, $teamId);
                    
                    if(null !== $token)
                    {
                        if(false === $token->isValid())
                        {
                            $DTO->type = 'SESSION_EXPIRED';
                        }
                        else 
                        {
                            $DTO->type = 'SESSION_VALID';
                            $DTO->user = $token->getUser();
                            $DTO->team = $team;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $DTO->errors[] = $e->getMessage();
        }

        $context = SerializationContext::create()->setGroups(array('default', 'details'));
        $data    = $serializer->serialize($DTO, 'json', $context);

        $response->setContent($data);

        return $response;
    }
}
