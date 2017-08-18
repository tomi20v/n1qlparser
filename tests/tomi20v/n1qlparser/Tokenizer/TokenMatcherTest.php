<?php

namespace tomi20v\n1qlchecker\Tokenizer;

use PHPUnit\Framework\TestCase;

class TokenMatcherTest extends TestCase
{

    /** @var StrategyInterface[]|\PHPUnit_Framework_MockObject_MockObject[] */
    private $strategies = [];
    /** @var TokenMatcher|\PHPUnit_Framework_MockObject_MockObject */
    private $tokenMatcher;
    private $anyString = 'any string';
    private $anyTokenType = 'tokenType';
    private $anyTokenContent = 'any token content';
    private $anyLength = 42;

    public function setUp()
    {
        $this->strategies[] = $this->getMockBuilder(StrategyInterface::class)
            ->getMock();
        $this->strategies[] = $this->getMockBuilder(StrategyInterface::class)
            ->getMock();
        $this->strategies[] = $this->getMockBuilder(StrategyInterface::class)
            ->getMock();
        $this->tokenMatcher = new TokenMatcher(
            $this->strategies
        );
    }

    public function testMatchShouldExecuteChain()
    {
        $this->allStrategiesMatch(null);
        $this->tokenMatcher->match($this->anyString);
    }

    public function testMatchShouldReturnNullIfNoHit()
    {
        $this->allStrategiesMatch(null);
        $result = $this->tokenMatcher->match($this->anyString);
        $this->assertNull($result);
    }

    public function testMatchShouldStopOnHitAndReturn()
    {
        $anyMatchResult = new MatchResult(
            $this->anyLength,
            new Token($this->anyTokenType, $this->anyTokenContent)
        );
        $this->strategyMatches(0, null);
        $this->strategyMatches(1, $anyMatchResult);
        $this->strategies[2]
            ->expects($this->never())
            ->method('match');
        $result = $this->tokenMatcher->match($this->anyString);
        $this->assertSame($anyMatchResult, $result);
    }

    private function allStrategiesMatch($result)
    {
        foreach ([0,1,2] as $i) {
            $this->strategyMatches($i, $result);
        }
    }

    private function strategyMatches(int $i, $result)   {
        return $this->strategies[$i]
            ->expects($this->once())
            ->method('match')
            ->willReturn($result);
    }

}
