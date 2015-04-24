<?php

namespace Miit\CoreDomainBundle\Serializer\EventSubscriber;

use Miit\CoreDomainBundle\Manager\TeamManager;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;

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
                'event'  => Events::PRE_SERIALIZE,
                'format' => 'json',
                'type'   => 'Miit\\CoreDomainBundle\\Entity\\User',
                'method' => 'onPreSerializeRolesToJson',
            ),
        );
    }

    /**
     * Convert the user to an array
     * 
     * @param PreSerializeEvent $event
     * 
     * @return array
     */
    public function onPreSerializeRolesToJson(PreSerializeEvent $event)
    {
        $user  = $event->getObject();
        $roles = $user->getRoles();
        $team  = $this->teamManager->getTeam();

        $isTeamAdmin = $user->hasRole($team->getAdminRole());
        $isTeamUser  = $user->hasRole($team->getUserRole());

        foreach ($roles as $role) {
            $user->demote($role);
        }

        if(true === $isTeamAdmin) {
            $user->promote('ADMIN');
        }

        if(true === $isTeamUser) {
            $user->promote('USER');
        }
    }
}