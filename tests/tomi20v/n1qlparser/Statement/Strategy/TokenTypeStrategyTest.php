<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use Tmilos\Lexer\Token;
use tomi20v\n1qlparser\Model\StatementFactoryResult;

class TokenTypeStrategyTest extends AbstractStrategyTestCase
{

    private $anyTokenType = 'anyTokenType';

    public function testBuildShouldReturnNewResultIfFound()
    {
        $this->anyAnnotations[$this->anyPropertyName]
            ->tokenType[] = 'any other type';
        $this->anyAnnotations[$this->anyPropertyName]
            ->tokenType[] = $this->anyTokenType;
        $anyValue = 'any other name';
        $tokens = [
            new Token($this->anyTokenType, $anyValue, 1, 2),
        ];
        $this->prevResultEmpty();
        $result = $this->callBuild($tokens);
        $this->assertNotSame($result, $this->anyPrevResult);
        $this->assertInstanceOf(StatementFactoryResult::class, $result);
        $this->assertEquals($result->statementPart, $anyValue);
        $this->assertEquals([$tokens[0]], $result->usedTokens);
    }

    public function testBuildShouldReturnPrevResultIfNotFound()
    {
        $this->anyAnnotations[$this->anyPropertyName]
            ->tokenType[] = $this->anyTokenType;
        $anyValue = 'any other name';
        $tokens = [
            new Token('other token type', $anyValue, 1, 2),
        ];
        $this->prevResultEmpty();
        $result = $this->callBuild($tokens);
        $this->assertSame($result, $this->anyPrevResult);
    }

    public function testBuildShouldReturnPrevResultIfNotEmpty()
    {
        $this->anyAnnotations[$this->anyPropertyName]
            ->tokenType[] = $this->anyTokenType;
        $anyValue = 'any other name';
        $tokens = [
            new Token($this->anyTokenType, $anyValue, 1, 2),
        ];
        $this->prevResultEmpty(false);
        $result = $this->callBuild($tokens);
        $this->assertSame($result, $this->anyPrevResult);
    }

    protected function createStrategy()
    {
        return new TokenTypeStrategy();
    }

}
