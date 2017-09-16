<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class TokenTypeAnnotationTest extends AnnotationTester
{

    protected function getAnnotationInstance()
    {
        return new TokenTypeAnnotation();
    }

    protected function getAnnotationProperty(PropertyAnnotation $annotation)
    {
        return $annotation->tokenType;
    }

}
