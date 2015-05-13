<?php

namespace Miit\AppBundle\Controller;

use Miit\CoreDomainBundle\Entity\SessionToken;

use Miit\CoreDomainBundle\Annotation\Permissions;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class SessionController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @Route("/session")
 */
class SessionController extends AppControllerAbstract
{
    /**
     * @Route("/renew",
     *      host="{team_slug}.{domain}",
     *      name="app_session_renew",
     *      defaults={
     *          "domain":    "%domain%"
     *      },
     *      requirements={
     *          "_method":   "GET",
     *          "domain":    "%domain%",
     *          "team_slug": ".{4,}"
     *      }
     * )
     * @Permissions(perm="USER")
     */
    public function renewAction(Request $request)
    {
        $response = $this->getDefaultResponse();
        $user     = $this->getUser();
        $team     = $this->getTeam();
        $session  = $request->getSession();

        $response['status'] = 'SESSION_DESTROY';

        try {
            // Anonyme
            if(null === $user && $session->has('virtual_id')) {
                $response['status']  = 'SESSION_RENEW';
                $response['session'] = $session->get('virtual_id');
            } else if(null !== $user) { // User
                $repository = $this->get('session_token_repository');

                $teamId = $team->getId();
                $userId = $user->getId();

                $token = $repository->findSessionTokenByUserIdAndTeamId($userId, $teamId);
                if(null === $token || !$token->isValid()) {
                    // Generate a new token
                    $token = new SessionToken($user, $team);
                    $repository->persist($token);
                }
                $response['status']  = 'SESSION_RENEW';
                $response['session'] = $token->getId();
            }

            $response['done'] = true;
        } catch (\Exception $e) {
            die(var_dump($e));
            $response['errors'][] = $e->getMessage();
        }

        return new JsonResponse($response);
    }
}
