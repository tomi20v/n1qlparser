<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

require_once('AnnotationTester.php');

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
