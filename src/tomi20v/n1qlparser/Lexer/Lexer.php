<?php

namespace tomi20v\n1qlparser\Lexer;

class Lexer
{

    /** @var TokenMatcher */
    private $tokenMatcher;

    public function __construct(
        TokenMatcher $tokenMatcher
    ) {
        $this->tokenMatcher = $tokenMatcher;
    }

    public function tokenize(string $what): array
    {
        $ret = [];

        while (strlen($what) > 0) {            $matchResult = null;
            $matchResult = $this->tokenMatcher->match($what);
            if (is_null($matchResult)) {
                throw new \RuntimeException('no tokenizer match');
            }
            if (!is_null($matchResult->token)) {
                $ret[] = $matchResult->token;
            }
            $what = substr($what, $matchResult->length);
        }

        return $ret;
    }

}
