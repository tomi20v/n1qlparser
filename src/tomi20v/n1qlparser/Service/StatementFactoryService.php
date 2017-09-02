<?php

namespace tomi20v\n1qlparser\Service;

use tomi20v\n1qlparser\Lexer\TokenProcessor;
use tomi20v\n1qlparser\Model\StatementRoot;
use tomi20v\n1qlparser\Statement\StatementFactory;

class StatementFactoryService
{

    /** @var StatementFactory */
    private $statementFactory;
    /** @var TokenProcessor */
    private $tokenProcessor;

    public function __construct(
        StatementFactory $statementFactory,
        TokenProcessor $tokenProcessor=null
    ) {
        $this->statementFactory = $statementFactory;
        $this->tokenProcessor = $tokenProcessor;
    }

    public function fromTokens(array $tokens)
    {
        $processedTokens = $this->tokenProcessor
            ? $this->tokenProcessor->preProcessTokens($tokens)
            : $tokens;
        $result = $this->statementFactory
            ->build($processedTokens, new StatementRoot());
        return $result;
    }

}
