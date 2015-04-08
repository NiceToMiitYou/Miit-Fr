<?php

namespace Miit\CoreDomain\Common;

use DomainDrivenDesign\Domain\Model\ValueObject;

/**
 * Class Email
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class Email implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string
     */
    public function __construct($value)
    {
        // Filter is 
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {

            throw new InvalidArgumentException();
        }

        $this->value = $value;
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
     * @param Email $email
     *
     * @return boolean
     */
    public function isEqualTo(Email $email)
    {
        return $this->getValue() === $email->getValue();
    }
}
