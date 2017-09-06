<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use PHPUnit\Framework\TestCase;
use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;

class RequiredStrategyTest extends TestCase
{

    /** @var RequiredStrategy */
    private $strategy;
    private $anyPropertyName = 'anyPropertyName';
    /** @var StatementFactoryResult|\PHPUnit_Framework_MockObject_MockObject */
    private $anyPrevResult;
    /** @var StatementFactoryInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $anyStatementFactory;


    public function setUp()
    {
        $this->strategy = new RequiredStrategy();
        $this->anyPrevResult = $this->getMockBuilder(StatementFactoryResult::class)
            ->getMock();
        $this->anyStatementFactory = $this->getMockBuilder(StatementFactoryInterface::class)
            ->getMock();
    }

    /**
     * @dataProvider returnsPrevResultProvider
     */
    public function testBuildReturnsPrevResult(bool $required, bool $prevResultEmpty)
    {
        $anyAnnotation = new PropertyAnnotation();
        $anyAnnotation->required = $required;

        $this->anyPrevResult
            ->expects($this->any())
            ->method('isEmpty')
            ->willReturn($prevResultEmpty);

        $result = $this->strategy->build(
            [],
            $this->anyPropertyName,
            [$this->anyPropertyName => $anyAnnotation,],
            $this->anyPrevResult,
            $this->anyStatementFactory
        );
        $this->assertSame($this->anyPrevResult, $result);
    }

    public function returnsPrevResultProvider()
    {
        return [
            [false, false],
            [false, true],
            [true, false],
        ];
    }

    /**
     * @expectedException \tomi20v\n1qlparser\Statement\Strategy\Exception\RequiredException
     */
    public function testBuildThrowsIfRequired()
    {
        $anyAnnotation = new PropertyAnnotation();
        $anyAnnotation->required = true;

        $this->anyPrevResult
            ->expects($this->any())
            ->method('isEmpty')
            ->willReturn(true);

        $this->strategy->build(
            [],
            $this->anyPropertyName,
            [$this->anyPropertyName => $anyAnnotation,],
            $this->anyPrevResult,
            $this->anyStatementFactory
        );

    }

}
