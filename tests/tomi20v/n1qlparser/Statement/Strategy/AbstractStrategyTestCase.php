<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use PHPUnit\Framework\TestCase;
use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;

abstract class AbstractStrategyTestCase extends TestCase
{

    /** @var SuffixStrategy */
    protected $strategy;
    protected $anyPropertyName = 'anyPropertyName';
    /** @var StatementFactoryResult|\PHPUnit_Framework_MockObject_MockObject */
    protected $anyPrevResult;
    /** @var StatementFactoryInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $anyStatementFactory;
    /** @var PropertyAnnotation[] */
    protected $anyAnnotations;

    public function setUp()
    {
        $this->strategy = $this->createStrategy();
        $this->anyPrevResult = $this->getMockBuilder(StatementFactoryResult::class)
            ->getMock();
        $this->anyAnnotations = [$this->anyPropertyName => new PropertyAnnotation(),];
        $this->anyStatementFactory = $this->getMockBuilder(StatementFactoryInterface::class)
            ->getMock();
    }

    public function testBuildShouldReturnPrevResult()
    {
        $result = $this->callBuild([]);
        $this->assertSame($result, $this->anyPrevResult);
    }

    protected function callBuild($tokens): StatementFactoryResult
    {
        return $this->strategy->build(
            $tokens,
            $this->anyPropertyName,
            $this->anyAnnotations,
            $this->anyPrevResult,
            $this->anyStatementFactory
        );
    }

    protected function prevResultEmpty($isEmpty=true)
    {
        $this->anyPrevResult
            ->expects($this->any())
            ->method('isEmpty')
            ->willReturn($isEmpty);
    }

    abstract protected function createStrategy();

}
