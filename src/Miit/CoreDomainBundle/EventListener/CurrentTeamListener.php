<?php

namespace Miit\CoreDomainBundle\EventListener;

use Miit\CoreDomainBundle\Manager\TeamManager;
use Miit\CoreDomainBundle\Repository\TeamRepository;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\NoResultException;

/**
 * Class CurrentTeamListener
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class CurrentTeamListener
{
    /**
     * @var TeamManager
     */
    private $teamManager;

    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * @var string
     */
    private $baseHost;

    /**
     * @param TeamManager     $teamManager
     * @param TeamRepository  $teamRepository
     * @param string          $baseHost
     */
    public function __construct(TeamManager $teamManager, TeamRepository $teamRepository, $baseHost)
    {
        $this->teamManager    = $teamManager;
        $this->teamRepository = $teamRepository;
        $this->baseHost       = strtolower($baseHost);
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $currentHost = strtolower(
            $event->getRequest()->getHttpHost()
        );

        // define the pattern
        $pattern   = sprintf('.%s', $this->baseHost);
        $subdomain = str_replace($pattern, '', $currentHost);

        // There is no subdomain
        if($subdomain === $currentHost) {

            $subdomain = '';
        }

        $redirect = false;

        // Allow team if more than 3 characters
        if(3 < strlen($subdomain)) {

            try {

                $team = $this->teamRepository->findTeamBySlug($subdomain);

                $this->teamManager->setCurrentTeam($team);

                $redirect = $team->isLocked();
            
            } catch(NoResultException $ex) {
                $redirect = true;
            }
        }

        if($redirect) {

            // No unlocked team found so redirect to home
            $url      = sprintf('http://www.%s/', $this->baseHost);
            $response = new RedirectResponse($url);

            return $event->setResponse($response);
        }
    }
}