<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Miit\MiitRepository as MiitRepositoryInterface;
use Miit\CoreDomain\Miit\Miit as MiitModel;
use Miit\CoreDomain\Miit\MiitId;

use Miit\CoreDomainBundle\Entity\Miit;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class CachedRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class CachedRepository extends EntityRepository
{
    /**
     * {@inheritDoc}
     */
    protected function setCache($query, $time = 3600) {
        $query->useQueryCache(true);
        $query->useResultCache(true);
        $query->setResultCacheLifetime($time);
    }
}
