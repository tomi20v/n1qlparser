<?php

namespace tomi20v\n1qlparser\Annotations;

use mindplay\annotations\IAnnotation;
use mindplay\annotations\IAnnotationParser;

class Annotation1Value implements IAnnotation, IAnnotationParser
{

    public $value;

    public function initAnnotation(array $properties)
    {
        $this->value = $properties[0];
    }

    /**
     * @param string $value The raw string value of the Annotation.
     * @return array An array of Annotation properties.
     */
    public static function parseAnnotation($value)
    {
        return [$value];
    }

}
