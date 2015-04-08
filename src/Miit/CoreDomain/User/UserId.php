<?php

namespace Miit\CoreDomain\User;

use DomainDrivenDesign\Domain\Model\ValueObject;

use Miit\CoreDomain\Common\UUID;

/**
 * Class UserId
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserId implements ValueObject
{
    /**
     * @var string The namespace of the UUID
     */
    const USER_NAMESPACE = '1196f4b9-201b-5453-9925-1eeb68492dce';

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
     * @param UserId $userId
     *
     * @return boolean
     */
    public function isEqualTo(UserId $userId)
    {
        return $this->getValue() === $userId->getValue();
    }

    /**
     * @return UserId
     */
    public static function newInstance()
    {
        return new UserId(
            UUID::v5(UserId::USER_NAMESPACE, UUID::v4())
        );
    }
}
