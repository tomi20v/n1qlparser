<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use Tmilos\Lexer\Token;
use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;
use tomi20v\n1qlparser\Statement\StrategyInterface;

class PatternStrategy implements StrategyInterface
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

        if (!$prevResult->isEmpty() && !empty($annotation->pattern)) {
            $found = false;
            /** @var Token $prevToken */
            $prevToken = $prevResult->usedTokens[0];
            foreach ($annotation->pattern as $eachPattern) {
                if ($this->match($eachPattern, $prevToken->getValue())) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                // @todo make specific exception here
                throw new \Exception();
            }
        }

        return $ret;
    }

    private function match($eachPattern, $getValue)
    {
        return preg_match(
            '/^' . $eachPattern . '$/',
            $getValue
        );
    }

}
