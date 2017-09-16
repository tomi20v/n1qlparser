<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class SuffixAnnotationTest extends AnnotationTester
{

    protected function getAnnotationInstance()
    {
        return new SuffixAnnotation();
    }

    protected function getAnnotationProperty(PropertyAnnotation $annotation)
    {
        return $annotation->suffix;
    }

}
