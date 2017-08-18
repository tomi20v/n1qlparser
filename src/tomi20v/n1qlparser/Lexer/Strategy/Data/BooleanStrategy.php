<?php

namespace tomi20v\n1qlparser\Lexer\Strategy\Data;

use tomi20v\n1qlparser\Lexer\StrategyAbstract;

class BooleanStrategy extends StrategyAbstract
{

    const PATTERNS = [
        'true',
        'false',
    ];

}
