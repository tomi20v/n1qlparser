<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;

class RequiredStrategyTest extends AbstractStrategyTestCase
{

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

    protected function createStrategy()
    {
        return new RequiredStrategy();
    }

}
