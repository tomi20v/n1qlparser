<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class NotWithAnnotationTest extends AnnotationTester
{

    protected function getAnnotationInstance()
    {
        return new NotWithAnnotation();
    }

    protected function getAnnotationProperty(PropertyAnnotation $annotation)
    {
        return $annotation->notWith;
    }

}
