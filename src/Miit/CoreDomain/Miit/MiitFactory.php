<?php

namespace Miit\CoreDomain\Miit;

use DomainDrivenDesign\Domain\Model\Factory;

/**
 * Interface MiitFactory
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
interface MiitFactory extends Factory
{
    /**
     * Return a new instance of miit
     * 
     * @param miitId  $miitId
     * @param string  $token
     * @param string  $name
     * @param mixed   $team
     * @param boolean $public
     * 
     * @return Miit
     */
    public function newIntance(MiitId $miitId, $token, $name, $team, $public);
}
