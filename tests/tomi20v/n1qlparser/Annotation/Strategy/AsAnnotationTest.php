<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class AsAnnotationTest extends AnnotationTester
{

    protected function getAnnotationInstance()
    {
        return new AsAnnotation();
    }

    protected function getAnnotationProperty(PropertyAnnotation $annotation)
    {
        return $annotation->as;
    }

}
