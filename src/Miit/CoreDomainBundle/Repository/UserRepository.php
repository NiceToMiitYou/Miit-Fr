<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserRepository as UserRepositoryInterface;
use Miit\CoreDomain\User\User as UserModel;
use Miit\CoreDomain\User\UserId;

use Miit\CoreDomainBundle\Entity\User;

use Doctrine\ORM\EntityRepository;

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
        $em = $this->getEntityManager();
    
        $query = $em->createQueryBuilder()
                    ->select('u')
                    ->from('MiitCoreDomainBundle:User ', 'u')
                    ->where('u.id = :id')
                    ->setParameter('id', $userId->getValue())
                    ->getQuery();

        return $query->getSingleResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByEmail(Email $email)
    {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                    ->select('u')
                    ->from('MiitCoreDomainBundle:User ', 'u')
                    ->where('u.email = :email')
                    ->setParameter('email', $email->getValue())
                    ->getQuery();

        return $query->getSingleResult();
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                    ->select('u')
                    ->from('MiitCoreDomainBundle:User ', 'u')
                    ->where('u.username = :username')
                    ->setParameter('username', $username)
                    ->getQuery();

        return $query->getSingleResult();
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
