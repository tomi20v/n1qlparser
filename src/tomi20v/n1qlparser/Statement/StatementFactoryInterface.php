<?php

namespace tomi20v\n1qlparser\Statement;

use tomi20v\n1qlparser\Model\StatementFactoryResult;

interface StatementFactoryInterface
{

    public function build(array $tokens, $node);

    public function buildProperty(
        array $tokens,
        string $propertyName,
        array $annotations
    ): StatementFactoryResult;

}
