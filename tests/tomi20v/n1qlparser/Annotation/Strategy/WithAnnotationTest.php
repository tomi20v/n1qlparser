<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

require_once('AnnotationTester.php');

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class WithAnnotationTest extends AnnotationTester
{

    protected function getAnnotationInstance()
    {
        return new WithAnnotation();
    }

    protected function getAnnotationProperty(PropertyAnnotation $annotation)
    {
        return $annotation->with;
    }

}
