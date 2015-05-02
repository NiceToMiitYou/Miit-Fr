<?php

namespace Miit\CoreDomain\User\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\User\UserId;

/**
 * Class RemoveTeamUserCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class RemoveTeamUserCommand implements Command
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var array
     */
    private $teams;

    /**
     * @param UserId $userId
     * @param string $teams
     */
    public function __construct(UserId $userId, $teams)
    {
        $this->userId = $userId;
        if(is_array($teams)) {
            $this->teams = $teams;
        } else {
            $this->teams = array($teams);
        }
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
