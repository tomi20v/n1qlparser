<?php

namespace tomi20v\n1qlparser\Lexer;

use PHPUnit\Framework\TestCase;
use Tmilos\Lexer\Token;

class TokenProcessorTest extends TestCase
{

    /** @var TokenProcessor */
    private $processor;
    /** @var Token[] */
    private $tokens;

    private $anyValue = 'any value';
    private $anyOtherValue = 'any other value';

    public function setUp()
    {
        $this->processor = new TokenProcessor();
        $this->tokens = [
            new Token('any name', $this->anyValue, 1, 3),
            new Token('any other name', $this->anyOtherValue, 5, 11),
        ];
    }

    public function testPreProcessTokensShouldCloneTokens()
    {
        $result = $this->processor->preProcessTokens($this->tokens);
        $this->assertCount(count($this->tokens), $result);
        $this->compare($this->tokens[0], $result[0]);
        $this->compare($this->tokens[1], $result[1]);
    }

    public function testPreProcessShouldTransformString()
    {
        $tokens = [
            new Token('data/string', '"' . $this->anyValue . '"', 0, 0),
            new Token('data/string', '\'' . $this->anyOtherValue . '\'', 0, 0),
        ];
        /** @var Token[] $result */
        $result = $this->processor->preProcessTokens($tokens);
        $this->assertEquals($this->anyValue, $result[0]->getValue());
        $this->assertEquals($this->anyOtherValue, $result[1]->getValue());
    }

    private function compare(Token $t1, Token $t2)
    {
        $this->assertNotSame($t1, $t2);
        $this->assertEquals($t1->getName(), $t2->getName());
        $this->assertEquals($t1->getValue(), $t2->getValue());
        $this->assertEquals($t1->getOffset(), $t2->getOffset());
        $this->assertEquals($t1->getPosition(), $t2->getPosition());
    }

}
