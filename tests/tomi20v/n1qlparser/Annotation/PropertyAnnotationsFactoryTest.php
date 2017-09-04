<?php

namespace tomi20v\n1qlparser\Annotation;

use PHPUnit\Framework\TestCase;
use tomi20v\n1qlparser\Annotation\Strategy\AsAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\NotWithAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\OptionalAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\PatternAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\SuffixAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\TokenTypeAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\WithAnnotation;

class PropertyAnnotationsFactoryTest extends TestCase
{

    private $anyKeyword = 'ANY KEYWORD';
    private $anyOtherKeyword = 'ANY OTHER KEYWORD';
    private $anyParams = 'any params blah';

    /** @var  StrategyInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $anyStrategy;
    /** @var  StrategyInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $anyOtherStrategy;
    /** @var PropertyAnnotationsFactory*/
    private $factory;

    public function setUp()
    {
        $this->anyStrategy = $this->getMockBuilder(StrategyInterface::class)->getMock();
        $this->anyOtherStrategy = $this->getMockBuilder(StrategyInterface::class)->getMock();
        $this->factory = new PropertyAnnotationsFactory([
            $this->anyStrategy,
            $this->anyOtherStrategy
        ]);
    }

    public function testConstructShouldDefaultStrategies()
    {
        $factory = new PropertyAnnotationsFactory();
        $strategiesProperty = new \ReflectionProperty($factory, 'strategies');
        $strategiesProperty->setAccessible(true);
        $strategies = $strategiesProperty->getValue($factory);
        $this->assertInstanceOf(AsAnnotation::class, $strategies[0]);
        $this->assertInstanceOf(PatternAnnotation::class, $strategies[1]);
        $this->assertInstanceOf(OptionalAnnotation::class, $strategies[2]);
        $this->assertInstanceOf(TokenTypeAnnotation::class, $strategies[3]);
        $this->assertInstanceOf(WithAnnotation::class, $strategies[4]);
        $this->assertInstanceOf(NotWithAnnotation::class, $strategies[5]);
        $this->assertInstanceOf(SuffixAnnotation::class, $strategies[6]);
    }

    public function testFromPhpDocReturns()
    {
        $factory = new PropertyAnnotationsFactory([]);
        $result = $factory->fromPhpDoc('');
        $this->assertInstanceOf(PropertyAnnotation::class, $result);
    }

    public function testFromPhpDocShouldInteract()
    {

        $phpdoc = $this->makePhpDoc();
        $this->mockFromPhpDoc($phpdoc);

        $this->factory->fromPhpDoc($phpdoc);

    }

    public function testShouldReturn()
    {

        $phpdoc = $this->makePhpDoc();
        $this->mockFromPhpDoc($phpdoc);

        $result = $this->factory->fromPhpDoc($phpdoc);
        $this->assertInstanceOf(PropertyAnnotation::class, $result);

    }

    /**
     * @param $phpdoc
     */
    private function mockFromPhpDoc($phpdoc)
    {

        $exploded = explode("\n", $phpdoc);
        $lineCnt = count($exploded);
        $this->anyStrategy->expects($this->exactly($lineCnt))->method('keyword')->willReturn($this->anyKeyword);
        $this->anyStrategy->expects($this->once())
            ->method('mutate')
            ->with($this->isInstanceOf(PropertyAnnotation::class), $this->anyParams);
        $this->anyOtherStrategy->expects($this->exactly($lineCnt))
            ->method('keyword')
            ->willReturn($this->anyOtherKeyword);
        $this->anyOtherStrategy->expects($this->once())
            ->method('mutate')
            ->with($this->isInstanceOf(PropertyAnnotation::class), null);
    }

    /**
     * @return string
     */
    private function makePhpDoc(): string
    {

        return '/**
        * @' . $this->anyKeyword . ' ' . $this->anyParams . '
        * @' . $this->anyOtherKeyword . '
';
    }

}
