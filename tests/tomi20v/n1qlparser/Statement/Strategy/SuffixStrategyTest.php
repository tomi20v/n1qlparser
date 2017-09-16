<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use Tmilos\Lexer\Token;
use tomi20v\n1qlparser\Model\StatementFactoryResult;

class SuffixStrategyTest extends AbstractStrategyTestCase
{

    private $anySuffix = 'anyTokenType';

    public function testBuildShouldReturnNewResultIfFound()
    {

        $anyOtherSuffix = 'any other suffix';
        $this->anyAnnotations[$this->anyPropertyName]
            ->suffix[] = $anyOtherSuffix;
        $this->anyAnnotations[$anyOtherSuffix]
            ->suffix[] = $this->anySuffix;
        $anyValue = 'any other name';
        $tokens = [
            new Token($this->anySuffix, $anyValue, 1, 2),
        ];
        $this->prevResultEmpty(false);
        $result = $this->callBuild($tokens);
        $this->assertSame($result, $this->anyPrevResult);
    }

    /**
     * @expectedException \tomi20v\n1qlparser\Annotation\AnnotationException
     * @expectedExceptionMessage invalid suffix "any invalid suffix"
     */
    public function testBuildShouldThrow()
    {
        $this->anyAnnotations[$this->anyPropertyName]
            ->suffix[] = 'any invalid suffix';
        $this->callBuild([]);
    }

    public function testReturnsEmptyResultIfSuffixNotFound()
    {
        $anyOtherSuffix = 'any other suffix';
        $this->anyAnnotations[$this->anyPropertyName]
            ->suffix[] = $anyOtherSuffix;
        $this->anyAnnotations[$anyOtherSuffix]
            ->suffix[] = $this->anySuffix;
        $anyValue = 'any other name';
        $tokens = [
            new Token($this->anySuffix, $anyValue, 1, 2),
        ];
        $this->anyPrevResult
            ->method('isEmpty')
            ->willReturn(false);
        $anyInnerResult = $this->getMockBuilder(StatementFactoryResult::class)->getMock();
        $anyInnerResult
            ->method('isEmpty')
            ->willReturn(true);
        $this->anyStatementFactory
            ->method('buildProperty')
            ->willReturn($anyInnerResult);

        $result = $this->callBuild($tokens);

        $this->assertInstanceOf(StatementFactoryResult::class, $result);
        $this->assertNotSame($this->anyPrevResult, $result);
        $this->assertEmpty($result->statementPart);

    }

    protected function createStrategy()
    {
        return new SuffixStrategy();
    }

}
