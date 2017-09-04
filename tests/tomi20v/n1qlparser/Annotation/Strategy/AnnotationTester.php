<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use PHPUnit\Framework\TestCase;
use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

abstract class AnnotationTester extends TestCase
{

    /** @var PropertyAnnotation */
    protected $propertyAnnotation;
    /** @var WithAnnotation */
    protected $annotation;

    protected $anyValue = 'any value';
    protected $anyOtherValue = 'any other value';

    public function setUp()
    {
        $this->propertyAnnotation = new PropertyAnnotation();
        $this->annotation = $this->getAnnotationInstance();
    }

    public function testMutateAddsResult()
    {
        $this->annotation->mutate(
            $this->propertyAnnotation,
            $this->anyValue
        );
        $annotationProperty = $this->getAnnotationProperty($this->propertyAnnotation);
        $this->assertCount(1, $annotationProperty);
        $this->assertEquals($this->anyValue, $annotationProperty[0]);
    }

    public function testMutateAddsAdditionalResults()
    {
        $this->annotation->mutate(
            $this->propertyAnnotation,
            $this->anyValue
        );
        $this->annotation->mutate(
            $this->propertyAnnotation,
            $this->anyOtherValue
        );
        $annotationProperty = $this->getAnnotationProperty($this->propertyAnnotation);
        $this->assertCount(2, $annotationProperty);
        $this->assertEquals($this->anyValue, $annotationProperty[0]);
        $this->assertEquals($this->anyOtherValue, $annotationProperty[1]);
    }

    abstract protected function getAnnotationInstance();
    abstract protected function getAnnotationProperty(PropertyAnnotation $annotation);

}
