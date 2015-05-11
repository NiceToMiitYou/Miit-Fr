<?php

namespace Miit\CoreDomainBundle\Security\Authorization\Voter;

use Miit\CoreDomain\User\User as UserModel;
use Miit\CoreDomain\Team\Team as TeamModel;
use Miit\CoreDomain\User\UserRepository;

use Miit\CoreDomainBundle\Manager\TeamManager;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * TeamVoter
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamVoter implements VoterInterface
{
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER  = 'USER';

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param TokenInterface $token
     * @param Team           $team
     * @param array          $attributes
     */
    public function vote(TokenInterface $token, $team, array $attributes)
    {
        // If not a team, DENIED
        if (!$this->supportsAttribute($attributes)) {
            return VoterInterface::ACCESS_DENIED;
        }

        // If not a team, DENIED
        if (!$team instanceof TeamModel) {
            return VoterInterface::ACCESS_DENIED;
        }

        // Retrieve the user
        $user = $token->getUser();

        // extract the role
        $role   = $attributes['role'];
        $strict = $attributes['strict'];

        switch ($role) {
            case TeamVoter::ROLE_USER:
                // Access Granted if the team is public
                if($team->isPublic() && false === $strict)
                {
                    return VoterInterface::ACCESS_GRANTED;
                }

            case TeamVoter::ROLE_ADMIN:
                if (
                    !$user instanceof UserInterface &&
                    !$user instanceof UserModel
                ) {
                    return VoterInterface::ACCESS_DENIED;
                }

                $isInTeam = $this->userRepository->isUserOfTeam($user->getId(), $team->getId());

                if(false === $isInTeam) {
                    return VoterInterface::ACCESS_DENIED;
                }

                $needed_role = $team->getRole($role);

                if($user->hasRole($needed_role)) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsAttribute($attributes)
    {
        if(
            !array_key_exists('role', $attributes) || 
            !array_key_exists('strict', $attributes)
        ) {
            return false;
        }

        $allowed = array(
            TeamVoter::ROLE_ADMIN,
            TeamVoter::ROLE_USER
        );

        return in_array($attributes['role'], $allowed);
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        $supportedClass = 'Miit\CoreDomain\Team\Team';

        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }
}