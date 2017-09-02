<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use Tmilos\Lexer\Token;
use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;
use tomi20v\n1qlparser\Statement\StrategyInterface;

class TokenTypeStrategy implements StrategyInterface
{

    public function build(
        array $tokens,
        string $propertyName,
        array $annotations,
        StatementFactoryResult $prevResult,
        StatementFactoryInterface $statementFactory
    ): StatementFactoryResult {

        $ret = $prevResult;
        $annotation = $annotations[$propertyName];

        if ($prevResult->isEmpty() && !empty($annotation->tokenType)) {
            /** @var Token $firstToken */
            $firstToken = $tokens[0];
            $firstTokenType = $firstToken->getName();
            foreach ($annotation->tokenType as $eachTokenType) {
                if ($eachTokenType == $firstTokenType) {
                    $ret = new StatementFactoryResult();
                    $ret->statementPart = $firstToken->getValue();
                    $ret->usedTokens = [$firstToken];
                    break;
                }
            }

        }

        return $ret;

    }
}
