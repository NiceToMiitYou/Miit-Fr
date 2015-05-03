<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserRepository as UserRepositoryInterface;
use Miit\CoreDomain\User\User as UserModel;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\Team\TeamId;

use Miit\CoreDomainBundle\Entity\User;

use Doctrine\ORM\EntityRepository;
use Doctrine\Orm\NoResultException;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * Class UserRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface, UserProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function findUserByUserId(UserId $userId)
    {
        $query = $this->createQueryBuilder('u')
                      ->where('u.id = :id')
                      ->setParameter('id', $userId->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByEmail(Email $email)
    {
        $query = $this->createQueryBuilder('u')
                      ->where('u.email = :email')
                      ->setParameter('email', $email->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findUsersByTeam(TeamId $teamId)
    {
        $query = $this->createQueryBuilder('u')
                      ->join('u.teams', 't')
                      ->where('t.id = :teamId')
                      ->orderBy('u.name', 'ASC')
                      ->setParameter('teamId', $teamId->getValue())
                      ->getQuery();

        return $query->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByUserIdWithTeams(UserId $userId)
    {
        $query = $this->createQueryBuilder('u')
                      ->join('u.teams', 't')
                      ->where('u.id = :id')
                      ->setParameter('id', $userId->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByUserIdAndTeamId(UserId $userId, TeamId $teamId)
    {
        $query = $this->createQueryBuilder('u')
                      ->join('u.teams', 't')
                      ->where('u.id = :userId')
                      ->andWhere('t.id = :teamId')
                      ->setParameter('userId', $userId->getValue())
                      ->setParameter('teamId', $teamId->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function isUserOfTeam(UserId $userId, TeamId $teamId)
    {
        $query = $this->createQueryBuilder('u')
                      ->select('COUNT(u)')
                      ->join('u.teams', 't')
                      ->where('u.id = :userId')
                      ->andWhere('t.id = :teamId')
                      ->setParameter('userId', $userId->getValue())
                      ->setParameter('teamId', $teamId->getValue())
                      ->getQuery();

        return 0 !== $query->getSingleScalarResult();
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $query = $this->createQueryBuilder('u')
                      ->where('u.email = :username') // The email is used instead of the username to login
                      ->andWhere('u.locked = :locked')
                      ->setParameter('locked',   false)
                      ->setParameter('username', $username)
                      ->getQuery();

        return $query->getSingleResult();
    }

    /**
     * @param UserId $userId
     * 
     * @return User
     */
    public function getReference(UserId $userId)
    {
        $em = $this->getEntityManager();
        
        return $em->getReference($this->getEntityName(), $userId);
    }

    /**
     * {@inheritDoc}
     */
    public function persist(UserModel $user)
    {
        $em = $this->getEntityManager();
        
        $em->persist($user);
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Miit\CoreDomaineBundle\Entity\User';
    }
}
