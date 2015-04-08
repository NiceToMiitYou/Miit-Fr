<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Team\TeamRepository as TeamRepositoryInterface;
use Miit\CoreDomain\Team\Team as TeamModel;
use Miit\CoreDomain\Team\TeamId;

use Miit\CoreDomainBundle\Entity\Team;

use Doctrine\ORM\EntityRepository;

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
        $em = $this->getEntityManager();
    
        $query = $em->createQueryBuilder()
                    ->select('t')
                    ->from('MiitCoreDomainBundle:Team ', 't')
                    ->where('t.id = :id')
                    ->setParameter('id', $teamId->getValue())
                    ->getQuery();

        return $query->getSingleResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findTeamBySlug($slug)
    {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                    ->select('t')
                    ->from('MiitCoreDomainBundle:Team ', 't')
                    ->where('t.slug = :slug')
                    ->setParameter('slug', $slug)
                    ->getQuery();

        return $query->getSingleResult();
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
