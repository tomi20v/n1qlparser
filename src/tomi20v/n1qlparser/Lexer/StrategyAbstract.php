<?php

namespace tomi20v\n1qlparser\Lexer;

abstract class StrategyAbstract implements StrategyInterface
{
    /** @var string[] */
    const PATTERNS = [];

    public function match(string $what)
//    public function match($what): ?array
    {
        foreach (static::PATTERNS as $eachPattern) {
            if (preg_match('/^' . $eachPattern . '/i', $what, $results)) {
                return $results;
            }
        }
        return null;
    }

}
