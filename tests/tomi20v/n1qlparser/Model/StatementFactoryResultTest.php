<?php

namespace tomi20v\n1qlparser\Model;

use PHPUnit\Framework\TestCase;

class StatementFactoryResultTest extends TestCase
{

    /**
     * @dataProvider isEmptyProvider
     */
    public function testIsEmptyReturns($statementPartValue, bool $expected)
    {
        $result = new StatementFactoryResult();
        $result->statementPart = $statementPartValue;
        $this->assertEquals($expected, $result->isEmpty());
    }

    public function isEmptyProvider()
    {
        return [
            [null, true],
            ['asd', false],
            ['123', false],
        ];
    }

}
