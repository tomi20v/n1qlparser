<?php

namespace tomi20v\n1qlchecker\Tokenizer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

class MatchResultTest extends TestCase
{

    private $anyLength = 12;

    public function testShouldConstruct()
    {
        /** @var Token|\PHPUnit_Framework_MockObject_MockObject $anyToken */
        $anyToken = $this->getMockBuilder(Token::class)
            ->disableOriginalConstructor()
            ->getMock();
        $matchResult = new MatchResult(
            $this->anyLength,
            $anyToken
        );
        $this->assertEquals($this->anyLength, $matchResult->length);
        $this->assertEquals($anyToken, $matchResult->token);
    }

}
