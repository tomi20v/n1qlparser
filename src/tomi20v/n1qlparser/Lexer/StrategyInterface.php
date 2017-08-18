<?php

namespace tomi20v\n1qlparser\Lexer;

interface StrategyInterface
{

    /**
     * @param string $what
     * @return MatchResult
     */
    public function match(string $what);
    // PHP7.1
//    public function match(string $what): ?MatchResult;
}
