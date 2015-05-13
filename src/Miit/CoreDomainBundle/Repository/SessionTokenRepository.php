<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\Team\TeamId;

use Miit\CoreDomainBundle\Entity\SessionToken;

/**
 * Class SessionTokenRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class SessionTokenRepository extends CachedRepository
{
    /**
     * @param UserId $userId
     * @param TeamId $teamId
     * 
     * @return SessionToken
     */
    public function findSessionTokenByUserIdAndTeamId(UserId $userId, TeamId $teamId)
    {
        $query = $this->createQueryBuilder('st')
                      ->join('st.user', 'u')
                      ->join('st.team', 't')
                      ->where('u.id = :userId')
                      ->andWhere('t.id = :teamId')
                      ->orderBy('st.expire', 'DESC')
                      ->setMaxResults(1)
                      ->setParameter('userId', $userId->getValue())
                      ->setParameter('teamId', $teamId->getValue())
                      ->getQuery();

        $this->setCache($query);

        return $query->getOneOrNullResult();
    }

    /**
     * @param string $id
     * @param UserId $userId
     * @param TeamId $teamId
     * 
     * @return SessionToken
     */
    public function findSessionTokenByIdAndUserIdAndTeamId($tokenId, UserId $userId, TeamId $teamId)
    {
        $query = $this->createQueryBuilder('st')
                      ->join('st.user', 'u')
                      ->join('st.team', 't')
                      ->where('st.id = :id')
                      ->andWhere('u.id = :userId')
                      ->andWhere('t.id = :teamId')
                      ->orderBy('st.expire', 'DESC')
                      ->setMaxResults(1)
                      ->setParameter('id',     $tokenId)
                      ->setParameter('userId', $userId->getValue())
                      ->setParameter('teamId', $teamId->getValue())
                      ->getQuery();

        $this->setCache($query);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function persist(SessionToken $token)
    {
        $em = $this->getEntityManager();
        
        $em->persist($token);
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Miit\CoreDomaineBundle\Entity\SessionToken';
    }
}
