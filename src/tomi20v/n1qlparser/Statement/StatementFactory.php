<?php

namespace tomi20v\n1qlparser\Statement;

use tomi20v\n1qlparser\Annotation\AnnotationManager;
use tomi20v\n1qlparser\Model\StatementFactoryResult;

class StatementFactory implements StatementFactoryInterface
{

    /** @var StrategyInterface[] */
    private $strategies;
    /** @var AnnotationManager */
    private $annotationManager;

    public function __construct(
        AnnotationManager $annotationManager,
        StrategyFactoryInterface $strategyFactory
    ) {
        $this->annotationManager = $annotationManager;
        $this->strategies = $strategyFactory->createStrategies();
    }

    public function build(array $tokens, $node)
    {
        $nodeClass = get_class($node);
        $annotations = $this->annotationManager
            ->allAnnotationByClass($nodeClass);
        $remainingTokens = $tokens;
        foreach ($annotations as $eachPropertyName => $eachAnnotation) {
            $result = $this->buildProperty(
                $remainingTokens,
                $eachPropertyName,
                $annotations
            );
            if (!$result->isEmpty()) {
                $node->$eachPropertyName = $result->statementPart;
                $remainingTokens = array_slice($remainingTokens, count($result->usedTokens));
            }
        }
        return $node;
    }

    /**
     * @todo move this to a propertyfactory class, then I can pass just
     *  the propertyfactory to the strategies
     * @param array $tokens
     * @param string $propertyName
     * @param array $annotations
     * @return StatementFactoryResult
     */
    public function buildProperty(
        array $tokens,
        string $propertyName,
        array $annotations
    ): StatementFactoryResult {
        $result = new StatementFactoryResult();
        foreach ($this->strategies as $eachStrategy) {
            $result = $eachStrategy->build(
                $tokens, $propertyName, $annotations, $result, $this
            );
        }
        return $result;
    }

}
