<?php

namespace Miit\CoreDomain\Miit\Command;

use DomainDrivenDesign\Domain\Command\Command;

use Miit\CoreDomain\Miit\MiitId;

/**
 * Class AddUserMiitCommand
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class AddUserMiitCommand implements Command
{
    /**
     * @var MiitId
     */
    private $miitId;

    /**
     * @var array
     */
    private $users;

    /**
     * @param MiitId $miitId
     * @param array  $users
     */
    public function __construct(MiitId $miitId, $users)
    {
        $this->miitId = $miitId;
        if(is_array($users)) {
            $this->users = $users;
        } else {
            $this->users = array($users);
        }
    }

    /**
     * @return MiitId
     */
    public function getMiitId()
    {
        return $this->miitId;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }
}
