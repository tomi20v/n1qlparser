<?php

namespace tomi20v\n1qlparser\Service;

use Tmilos\Lexer\Config\LexerConfig;

class LexerService
{

    /** @var LexerConfig */
    private $lexerConfig;

    public function __construct(
        LexerConfig $lexerConfig
    ) {
        $this->lexerConfig = $lexerConfig;
    }

    public function tokenize(string $what): array
    {
        return \Tmilos\Lexer\Lexer::scan($this->lexerConfig, $what);
    }

}
