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
     * @var TeamManager
     */
    private $teamManager;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param TeamManager    $teamManager
     * @param UserRepository $userRepository
     */
    public function __construct(TeamManager $teamManager, UserRepository $userRepository)
    {
        $this->teamManager    = $teamManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @param TokenInterface $token
     * @param Team           $team
     * @param array          $attributes
     */
    public function vote(TokenInterface $token, $team, array $attributes)
    {
        // Retrieve the user
        $user = $token->getUser();

        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface && !$user instanceof UserModel) {
            return VoterInterface::ACCESS_DENIED;
        }

        if ($team instanceof TeamModel) {
            $isInTeam = $this->userRepository->isUserOfTeam($user->getId(), $team->getId());

            if(false === $isInTeam) {
                return VoterInterface::ACCESS_DENIED;
            }
        }

        // extract the role
        $role = reset($attributes);

        switch ($role) {
            case TeamVoter::ROLE_USER:
            case TeamVoter::ROLE_ADMIN:

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
    public function supportsAttribute($attribute)
    {
        $allowed = array(
            TeamVoter::ROLE_ADMIN,
            TeamVoter::ROLE_USER
        );

        return in_array($attribute, $allowed);
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