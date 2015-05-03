<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Team\TeamRepository as TeamRepositoryInterface;
use Miit\CoreDomain\Team\Team as TeamModel;
use Miit\CoreDomain\Team\TeamId;

use Miit\CoreDomainBundle\Entity\Team;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class TeamRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamRepository extends EntityRepository implements TeamRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findTeamByTeamId(TeamId $teamId)
    {
        $query = $this->createQueryBuilder('t')
                      ->where('t.id = :id')
                      ->setParameter('id', $teamId->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findTeamByTeamIdWithUsers(TeamId $teamId)
    {
        $query = $this->createQueryBuilder('t')
                      ->where('t.id = :id')
                      ->join('t.users', 'u')
                      ->setParameter('id', $teamId->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findTeamBySlug($slug)
    {
        $query = $this->createQueryBuilder('t')
                      ->where('t.slug = :slug')
                      ->setParameter('slug', $slug)
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @param TeamId $teamId
     * 
     * @return Team
     */
    public function getReference(TeamId $teamId)
    {
        $em = $this->getEntityManager();
        
        return $em->getReference($this->getEntityName(), $teamId);
    }

    /**
     * {@inheritDoc}
     */
    public function persist(TeamModel $team)
    {
        $em = $this->getEntityManager();
        
        $em->persist($team);
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Miit\CoreDomaineBundle\Entity\Team';
    }
}
