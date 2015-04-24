<?php

namespace Miit\CoreDomainBundle\Serializer\EventSubscriber;

use Miit\CoreDomainBundle\Manager\TeamManager;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\ObjectEvent;

/**
 * UserRoleEventSubscriber
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserRoleEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var TeamManager
     */
    private $teamManager;

    /**
     * @param TeamManager $teamManager
     */
    public function __construct(TeamManager $teamManager)
    {
        $this->teamManager = $teamManager;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event'  => Events::POST_SERIALIZE,
                'format' => 'json',
                'type'   => 'Miit\\CoreDomainBundle\\Entity\\User',
                'method' => 'onPostSerializeTaskJson',
            ),
        );
    }

    /**
     * Convert the user to an array
     * 
     * @param ObjectEvent $event
     * 
     * @return array
     */
    public function onPostSerializeTaskJson(ObjectEvent $event)
    {
        $user  = $event->getObject();
        $team  = $this->teamManager->getTeam();
        $roles = array();

        $isTeamAdmin = $user->hasRole($team->getAdminRole());
        $isTeamUser  = $user->hasRole($team->getUserRole());

        if(true === $isTeamAdmin) {
            array_push($roles, 'ADMIN');
        }

        if(true === $isTeamUser) {
            array_push($roles, 'USER');
        }

        $event->getVisitor()->addData('roles', $roles);
    }
}