<?php

namespace Merexo;

use ReflectionClass;

class CustomPrinter
{
    public static function print_r($value, $dimension = 0)
    {
        if ($dimension > 0) {
            $dimension++; // for spaces like in print_r
        }

        $next_dimension = $dimension + 1;

        if (is_array($value)) {
            self::print_start_definition('Array', $dimension);

            foreach ($value as $key => $v) {
                self::print_spaces($next_dimension);

                self::print_array_key($key);
                self::print_r($v, $next_dimension);
            }

            self::print_end_definition($dimension);
            return;
        }

        if (is_object($value)) {
            $class = get_class($value);
            self::print_start_definition("$class Object", $dimension);

            foreach (self::get_object_properties($value) as $prop) {
                self::print_spaces($next_dimension);

                $prop_v = self::get_object_property_value($prop, $value);

                self::print_object_key($prop, $class);
                self::print_r($prop_v, $next_dimension);
            }

            self::print_end_definition($dimension);
            return;
        }

        echo $value . PHP_EOL;
    }

    private static function get_object_properties($object)
    {
        $reflector = new ReflectionClass($object);

        return $reflector->getProperties();
    }

    private static function get_object_property_value(\ReflectionProperty $prop, $object)
    {
        $prop->setAccessible(true);

        return $prop->getValue($object);
    }

    private static function define_type(\ReflectionProperty $prop, $class_name)
    {
        if ($prop->isPrivate()) return $class_name . ':private';
        if ($prop->isProtected()) return 'protected';
        if ($prop->isPublic()) return 'public';

        return '';
    }

    private static function print_start_definition($type_name, $dim)
    {
        echo $type_name . PHP_EOL;
        self::print_spaces($dim);
        echo '(' . PHP_EOL;
    }

    private static function print_end_definition($dimension)
    {
        self::print_spaces($dimension);
        echo ')' . PHP_EOL;
    }

    private static function print_array_key($key)
    {
        echo "[$key] => ";
    }

    private static function print_object_key(\ReflectionProperty$prop, $class)
    {
        echo '[' . $prop->getName() . ':' . self::define_type($prop, $class) . '] => ';
    }

    private static function print_spaces($dim = 0)
    {
        for ($i = 0; $i < $dim; $i++) {
            echo '    ';
        }
    }
}