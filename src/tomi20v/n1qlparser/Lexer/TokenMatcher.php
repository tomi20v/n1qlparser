<?php

namespace tomi20v\n1qlparser\Lexer;

class TokenMatcher
{

    /** @var StrategyInterface[] */
    private $strategies;

    public function __construct(
        array $strategies
    ) {
        $this->strategies = $strategies;
    }

    /**
     * @param string $what
     * @return MatchResult
     */
    public function match(string $what)
    // php7.1
//    public function matchOne(string $what): ?MatchResult
    {
        $result = null;
        foreach ($this->strategies as $eachStrategy) {
            $result = $eachStrategy->match($what);
            if (!is_null($result)) {
                break;
            }
        }
        return $result;
    }

}
