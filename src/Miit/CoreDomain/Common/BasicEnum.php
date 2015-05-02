<?php

namespace Miit\CoreDomain\Common;

/**
 * Class BasicEnum
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
abstract class BasicEnum {

    private static $constCacheArray = NULL;

    /**
     * Get the list of constants
     * 
     * @return array
     */
    private static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }

        $calledClass = get_called_class();
        
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    /**
     * Try to validate the name of the enum
     * 
     * @param string  $name
     * @param boolean $strict
     * 
     * @return bolean
     */
    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map(
            'strtolower', 
            array_keys($constants)
        );

        return in_array(strtolower($name), $keys);
    }

    /**
     * Try to validate the value of the enum
     * 
     * @param string  $name
     * 
     * @return bolean
     */
    public static function isValidValue($value) {
        $values = array_values(
            self::getConstants()
        );

        return in_array($value, $values, $strict = true);
    }
}