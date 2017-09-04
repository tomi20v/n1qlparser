<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use PHPUnit\Framework\TestCase;
use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class OptionalAnnotationTest extends TestCase
{

    /** @var PropertyAnnotation */
    protected $propertyAnnotation;
    /** @var OptionalAnnotation */
    protected $annotation;

    public function setUp()
    {
        $this->propertyAnnotation = new PropertyAnnotation();
        $this->annotation = new OptionalAnnotation();
    }

    public function testSetsRequiredToFalse()
    {
        $this->annotation->mutate($this->propertyAnnotation, null);
        $this->assertFalse($this->propertyAnnotation->required);
    }

}
