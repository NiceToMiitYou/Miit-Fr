<?php

namespace Miit\CoreDomain\Miit;

use DomainDrivenDesign\Domain\Model\ValueObject;

use Miit\CoreDomain\Common\UUID;

/**
 * Class MiitId
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class MiitId implements ValueObject
{
    /**
     * @var string The namespace of the UUID
     */
    const MIIT_NAMESPACE = '8207541d-1aae-5fa7-d043-1683b85badcf';

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
     * @param MiitId $miitId
     *
     * @return boolean
     */
    public function isEqualTo(MiitId $miitId)
    {
        return $this->getValue() === $miitId->getValue();
    }

    /**
     * @return MiitId
     */
    public static function newInstance()
    {
        return new MiitId(
            UUID::v5(MiitId::MIIT_NAMESPACE, UUID::v4())
        );
    }
}
