<?php

namespace Miit\CoreDomainBundle\Repository;

use Miit\CoreDomain\Commom\Email;

use Miit\CoreDomainBundle\Entity\NewsLetter;

/**
 * Class NewsLetterRepository
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class NewsLetterRepository extends CachedRepository
{
    /**
     * {@inheritDoc}
     */
    public function persist(NewsLetter $newsLetter)
    {
        $em = $this->getEntityManager();
        
        $em->persist($newsLetter);
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Miit\CoreDomaineBundle\Entity\NewsLetter';
    }
}
