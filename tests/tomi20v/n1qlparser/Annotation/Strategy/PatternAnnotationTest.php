<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class PatternAnnotationTest extends AnnotationTester
{

    protected function getAnnotationInstance()
    {
        return new PatternAnnotation();
    }

    protected function getAnnotationProperty(PropertyAnnotation $annotation)
    {
        return $annotation->pattern;
    }

}
