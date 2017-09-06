<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;
use tomi20v\n1qlparser\Statement\Strategy\Exception\RequiredException;
use tomi20v\n1qlparser\Statement\StrategyInterface;

class RequiredStrategy implements StrategyInterface
{

    public function build(
        array $tokens,
        string $propertyName,
        array $annotations,
        StatementFactoryResult $prevResult,
        StatementFactoryInterface $statementFactory
    ): StatementFactoryResult {

        if ($annotations[$propertyName]->required && $prevResult->isEmpty()) {
            throw new RequiredException();
        }

        return $prevResult;

    }
}
