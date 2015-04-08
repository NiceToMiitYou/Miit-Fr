<?php

namespace Miit\CoreDomain\Team;

use DomainDrivenDesign\Domain\Model\ValueObject;

use Miit\CoreDomain\Common\UUID;

/**
 * Class TeamId
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TeamId implements ValueObject
{
    /**
     * @var string The namespace of the UUID
     */
    const TEAM_NAMESPACE = '813b064c-8688-595f-bd94-10cf75ed3c8a';

    /**
     * @var string
     */
    private $value;

    /**
     * @param string
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s', $this->getValue());
    }

    /**
     * @param TeamId $teamId
     *
     * @return boolean
     */
    public function isEqualTo(TeamId $teamId)
    {
        return $this->getValue() === $teamId->getValue();
    }

    /**
     * @return TeamId
     */
    public static function newInstance()
    {
        return new TeamId(
            UUID::v5(TeamId::TEAM_NAMESPACE, UUID::v4())
        );
    }
}
