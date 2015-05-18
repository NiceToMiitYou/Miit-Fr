<?php

namespace Miit\CoreDomainBundle\Serializer\EventSubscriber;

use Miit\CoreDomain\Team\Team;

use Miit\CoreDomainBundle\Entity\User;
use Miit\CoreDomainBundle\Manager\TeamManager;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
     * @var TokenStorageInterface
     */
    private $context;

    /**
     * @var User
     */
    public function getUser()
    {
        return $this->storage->getToken()->getUser();
    }

    /**
     * @param TokenStorageInterface $storage
     * @param TeamManager           $teamManager
     */
    public function __construct(TokenStorageInterface $storage, TeamManager $teamManager)
    {
        $this->storage     = $storage;
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

        // Transform roles
        foreach ($allowed as $tmp) {
            $role = $team->getRole($tmp);

            if(true === $user->hasRole($role)) {
                array_push($roles, $tmp);
            }
        }

        // Add roles
        $event->getVisitor()->addData('roles', $roles);

        // Add email if not anonym
        if($this->getUser() instanceof User)
        {
            $email = $user->getEmail()->getValue();
            $event->getVisitor()->addData('email', $email);
        }
    }
}