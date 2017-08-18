<?php

namespace tomi20v\n1qlparser\Lexer;

class MatchResult
{
    /** @var int */
    public $length;
    /** @var Token */
    public $token;

    public function __construct(
        int $length,
        Token $token
    ) {
        $this->length = $length;
        $this->token = $token;
    }

}
