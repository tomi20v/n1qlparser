<?php

namespace tomi20v\n1qlparser\Annotation;

use PHPUnit\Framework\TestCase;

class AnnotationManagerTest extends TestCase
{

    const CLASS_PRE = '
namespace tomi20v\n1qlparser\Annotation;
class AnnotatedTestClass
{
';
    const PHPDOC = '
/**
 * @annotation
 */
';
    const CLASS_POST = '
        public $anyProperty;
        
        public $anyOtherProperty;
};
';

    /** @var  PropertyAnnotationsFactory|\PHPUnit_Framework_MockObject_MockObject */
    private $propertyAnnotationsFactory;
    /** @var AnnotationManager */
    private $annotationManager;

    private $testClassname = 'tomi20v\n1qlparser\Annotation\AnnotatedTestClass';
    private $testProperty = 'anyProperty';
    private $otherTestProperty = 'anyOtherProperty';

    public function setUp()
    {
        $this->propertyAnnotationsFactory = $this
            ->getMockBuilder(PropertyAnnotationsFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->annotationManager = new AnnotationManager(
            $this->propertyAnnotationsFactory
        );
    }

    public function testAnnotationByClassShouldInteract()
    {
        $anyAnnotations = new PropertyAnnotation();
        $this->propertyAnnotationsFactory
            ->expects($this->once())
            ->method('fromPhpDoc')
            ->with($this->callback(function($doc) {
                $this->assertEquals(trim($doc), trim(self::PHPDOC));
                return true;
            }))
            ->willReturn($anyAnnotations);
        $result = $this->annotationManager->annotationByClass(
            $this->testClassname,
            $this->testProperty
        );
        $this->assertSame($anyAnnotations, $result);
    }

    public function testAllAnnotationsByClassShouldInteract()
    {
        $anyAnnotation = new PropertyAnnotation();
        $anyOtherAnnotation = new PropertyAnnotation();
        /** @var AnnotationManager|\PHPUnit_Framework_MockObject_MockObject $manager */
        $manager = $this->getMockBuilder(AnnotationManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['annotationByClass'])
            ->getMock();
        $manager
            ->expects($this->at(0))
            ->method('annotationByClass')
            ->with(
                $this->testClassname,
                $this->testProperty
            )
            ->willReturn($anyAnnotation);
        $manager
            ->expects($this->at(1))
            ->method('annotationByClass')
            ->with(
                $this->testClassname,
                $this->otherTestProperty
            )
            ->willReturn($anyOtherAnnotation);

        $result = $manager->allAnnotationByClass($this->testClassname);
        $this->assertCount(2, $result);
        $this->assertSame($anyAnnotation, $result[$this->testProperty]);
        $this->assertSame($anyOtherAnnotation, $result[$this->otherTestProperty]);
    }

}

$classDefinition = AnnotationManagerTest::CLASS_PRE . AnnotationManagerTest::PHPDOC . AnnotationManagerTest::CLASS_POST;
eval($classDefinition);
