<?php

namespace Miit\CoreDomainBundle\Serializer\EventSubscriber;

use Miit\CoreDomain\Team\Team;

use Miit\CoreDomainBundle\Entity\User;
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
                'class'  => User::class,
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
        $user    = $event->getObject();
        $team    = $this->teamManager->getTeam();
        $roles   = array();

        $allowed = Team::getAllowedRoles();

        foreach ($allowed as $tmp) {
            $role = $team->getRole($tmp);

            if(true === $user->hasRole($role)) {
                array_push($roles, $tmp);
            }
        }

        $event->getVisitor()->addData('roles', $roles);
    }
}