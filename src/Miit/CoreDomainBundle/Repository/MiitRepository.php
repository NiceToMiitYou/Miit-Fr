<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Miit\MiitRepository as MiitRepositoryInterface;
use Miit\CoreDomain\Miit\Miit as MiitModel;
use Miit\CoreDomain\Miit\MiitId;
use Miit\CoreDomain\Team\TeamId;

use Miit\CoreDomainBundle\Entity\Miit;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class MiitRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitRepository extends CachedRepository implements MiitRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findMiitByMiitId(MiitId $miitId)
    {
        $query = $this->createQueryBuilder('m')
                      ->where('m.id = :id')
                      ->setParameter('id', $miitId->getValue())
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findMiitByTeamAndToken(TeamId $teamId, $token)
    {
        $query = $this->createQueryBuilder('m')
                      ->where('m.token = :token')
                      ->andWhere('m.team = :teamId')
                      ->setParameter('teamId', $teamId->getValue())
                      ->setParameter('token', $token)
                      ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @param MiitId $miitId
     * 
     * @return Miit
     */
    public function getReference(MiitId $miitId)
    {
        $em = $this->getEntityManager();
        
        return $em->getReference($this->getEntityName(), $miitId);
    }

    /**
     * {@inheritDoc}
     */
    public function persist(MiitModel $miit)
    {
        $em = $this->getEntityManager();
        
        $em->persist($miit);
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Miit\CoreDomaineBundle\Entity\Miit';
    }
}
