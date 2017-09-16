<?php

namespace tomi20v\n1qlparser\Statement\Strategy;

use tomi20v\n1qlparser\Annotation\AnnotationException;
use tomi20v\n1qlparser\Model\StatementFactoryResult;
use tomi20v\n1qlparser\Statement\StatementFactoryInterface;
use tomi20v\n1qlparser\Statement\StrategyInterface;

class SuffixStrategy implements StrategyInterface
{

    public function build(
        array $tokens,
        string $propertyName,
        array $annotations,
        StatementFactoryResult $prevResult,
        StatementFactoryInterface $statementFactory
    ): StatementFactoryResult {

        $annotation = $annotations[$propertyName];

        $isEmpty = $prevResult->isEmpty();
        if (!$isEmpty && !empty($annotation->suffix)) {

            $found = false;
            foreach ($annotation->suffix as $eachSuffix) {
                if (!isset($annotations[$eachSuffix])) {
                    throw new AnnotationException('invalid suffix "' . $eachSuffix . '"');
                }
                $tokensSlice = array_slice($tokens, 1);
                $result = $statementFactory
                    ->buildProperty($tokensSlice, $eachSuffix, $annotations);
                $found = !$result->isEmpty();
                if ($found) {
                    break;
                }
            }

            if (!$found) {
                $prevResult = new StatementFactoryResult();
            }

        }

        return $prevResult;

    }

}
