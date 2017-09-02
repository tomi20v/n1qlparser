<?php

namespace tomi20v\n1qlparser\Statement;

use Tmilos\Lexer\Token;
use tomi20v\n1qlparser\Model\StatementFactoryResult;

interface StrategyInterface
{

    /**
     * how many tokens can we use. normally should match $prevResult
     *
     * @param Token[] $tokens
     * @param string $propertyName
     * @param array $annotations
     * @param StatementFactoryResult $prevResult
     * @param StatementFactoryInterface $statementFactory
     * @return StatementFactoryResult
     * @internal param PropertyAnnotations $annotation
     */
    public function build(
        array $tokens,
        string $propertyName,
        array $annotations,
        StatementFactoryResult $prevResult,
        StatementFactoryInterface $statementFactory
    ): StatementFactoryResult;

}
