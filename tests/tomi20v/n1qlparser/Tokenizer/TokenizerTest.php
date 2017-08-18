<?php

namespace tomi20v\n1qlchecker\Tokenizer;

use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase
{

    /** @var Token */
    private $anyToken;
    /** @var MatchResult */
    private $anyMatchResult;
    /** @var TokenMatcher|\PHPUnit_Framework_MockObject_MockObject */
    private $tokenMatcher;
    /** @var Tokenizer|\PHPUnit_Framework_MockObject_MockObject */
    private $tokenizer;
    private $anyString = 'any string';
    private $anyMatchType = 'anyMatchType';
    private $anyTokenContent = 'any token content';
    private $anyLength = 42;

    public function setUp()
    {

        $this->anyToken = new Token(
            $this->anyMatchType,
            $this->anyTokenContent
        );
        $this->anyMatchResult = new MatchResult(
            $this->anyLength,
            $this->anyToken
        );

        $this->tokenMatcher = $this->getMockBuilder(TokenMatcher::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->tokenizer = new Tokenizer([
            $this->tokenMatcher
        ]);
    }

    public function testTokenizeShouldReturnEmpty()
    {
        $this->tokenMatcher
            ->expects($this->never())
            ->method('match');
        $result = $this->tokenizer->tokenize('');
        $this->assertTrue(is_array($result));
        $this->assertCount(0, $result);
    }

    public function testTokenizeShouldCallAllMatchers()
    {
        $tokenMatchers = [
            $this->tokenMatcher,
            $this->getMockBuilder(TokenMatcher::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];
        $tokenMatchers[1]
            ->expects($this->once())
            ->method('match')
            ->with($this->anyString)
            ->willReturn($this->anyMatchResult);
        $tokenizer = new Tokenizer($tokenMatchers);
        $tokenizer->tokenize($this->anyString);

    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage no tokenizer match
     */
    public function testTokenizeShouldThrowIfNoResult()
    {
        $this->tokenMatcherReturnsOnce(null);
        $this->tokenizer->tokenize($this->anyString);
    }

    public function xtestTokenizeReturnsMatches()
    {
        $anyMatchResult = new MatchResult(
            $this->anyLength,
            $this->anyToken
        );
        $this->tokenMatcherReturnsOnce($anyMatchResult);
        $result = $this->tokenizer->tokenize($this->anyString);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Token::class, $result[0]);

    }

    private function tokenMatcherReturnsOnce($what)
    {
        $this->tokenMatcher
            ->expects($this->once())
            ->method('match')
            ->with($this->anyString)
            ->willReturn($what);
    }

}
