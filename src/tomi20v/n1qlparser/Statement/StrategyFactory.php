<?php

namespace tomi20v\n1qlparser\Statement;

use tomi20v\n1qlparser\Statement\Strategy\PatternStrategy;
use tomi20v\n1qlparser\Statement\Strategy\RequiredStrategy;
use tomi20v\n1qlparser\Statement\Strategy\SuffixStrategy;
use tomi20v\n1qlparser\Statement\Strategy\TokenTypeStrategy;

class StrategyFactory implements StrategyFactoryInterface
{

    public function createStrategies(): array
    {
        return [
            new TokenTypeStrategy(),
            new RequiredStrategy(),
            new PatternStrategy(),
            new SuffixStrategy(),
        ];
    }
}
