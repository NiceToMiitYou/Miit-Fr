<?php

namespace Miit\CoreDomain\Miit\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Miit\MiitId;

/**
 * Class UpdateMiitCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class UpdateMiitCommand implements Command
{
    /**
     * @var MiitId
     */
    private $miitId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $public;

    /**
     * @param MiitId  $miitId
     * @param string  $name
     * @param boolean $public
     */
    public function __construct(MiitId $miitId, $name, $public)
    {
        $this->miitId = $miitId;
        $this->name   = (string) $name;
        $this->public = $public;
    }

    /**
     * @return MiitId
     */
    public function getMiitId()
    {
        return $this->miitId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }
}
