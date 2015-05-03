<?php

namespace Miit\CoreDomain\Miit\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Miit\MiitId;

/**
 * Class CreateMiitCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class CreateMiitCommand implements Command
{
    /**
     * @var MiitId
     */
    private $miitId;

    /**
     * @var string
     */
    private $token;
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $team;

    /**
     * @var boolean
     */
    private $public;

    /**
     * @param MiitId  $miitId
     * @param string  $token
     * @param string  $name
     * @param mixed   $team
     * @param boolean $public
     */
    public function __construct(MiitId $miitId, $token, $name, $team, $public = false)
    {
        $this->miitId = $miitId;
        $this->token  = (string) $token;
        $this->name   = (string) $name;
        $this->team   = $team;
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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }
}
