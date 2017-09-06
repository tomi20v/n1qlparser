<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use PHPUnit\Framework\TestCase;
use Tmilos\Lexer\Token;
use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;

class SuffixStrategyTest extends TestCase
{

    /** @var SuffixStrategy */
    private $strategy;
    private $anyPropertyName = 'anyPropertyName';
    /** @var StatementFactoryResult|\PHPUnit_Framework_MockObject_MockObject */
    private $anyPrevResult;
    /** @var StatementFactoryInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $anyStatementFactory;
    /** @var PropertyAnnotation[] */
    private $anyAnnotations;

    private $anySuffix = 'anyTokenType';

    public function setUp()
    {
        $this->strategy = new SuffixStrategy();
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

    public function testBuildShouldReturnNewResultIfFound()
    {
        $this->anyAnnotations[$this->anyPropertyName]
            ->suffix[] = 'any other suffix';
        $this->anyAnnotations[$this->anyPropertyName]
            ->suffix[] = $this->anySuffix;
        $anyValue = 'any other name';
        $tokens = [
            new Token($this->anySuffix, $anyValue, 1, 2),
        ];
        $this->prevResultEmpty();
        $result = $this->callBuild($tokens);
        $this->assertNotSame($result, $this->anyPrevResult);
        $this->assertInstanceOf(StatementFactoryResult::class, $result);
        $this->assertEquals($result->statementPart, $anyValue);
        $this->assertEquals([$tokens[0]], $result->usedTokens);
    }

    private function callBuild($tokens): StatementFactoryResult
    {
        return $this->strategy->build(
            $tokens,
            $this->anyPropertyName,
            $this->anyAnnotations,
            $this->anyPrevResult,
            $this->anyStatementFactory
        );
    }

    private function prevResultEmpty($isEmpty=true)
    {

        $this->anyPrevResult
            ->expects($this->any())
            ->method('isEmpty')
            ->willReturn($isEmpty);
    }

}
