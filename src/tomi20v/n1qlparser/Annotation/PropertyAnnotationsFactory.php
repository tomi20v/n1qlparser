<?php

namespace tomi20v\n1qlparser\Annotation;

use tomi20v\n1qlparser\Annotation\Strategy\NotWithAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\SuffixAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\TokenTypeAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\AsAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\OptionalAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\PatternAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\WithAnnotation;

class PropertyAnnotationsFactory
{

    /** @var StrategyInterface[] */
    private $strategies;

    public function __construct(array $strategies = null)
    {
        $this->strategies = $strategies ?: [
            new AsAnnotation(),
            new PatternAnnotation(),
            new OptionalAnnotation(),
            new TokenTypeAnnotation(),
            new WithAnnotation(),
            new NotWithAnnotation(),
            new SuffixAnnotation(),
        ];
    }

    public function fromPhpDoc(string $phpDoc): PropertyAnnotation
    {
        $annotations = new PropertyAnnotation();
        $doc = explode("\n", $phpDoc);
        foreach ($doc as $eachLine) {
            foreach ($this->strategies as $eachStrategy) {
                $pattern = '/\*\s+@' . $eachStrategy->keyword() . '(\s+(.+)\s*)?$/';
                if (preg_match($pattern, $eachLine, $matches)) {
                    $match = isset($matches[2]) ? $matches[2] : null;
                    $eachStrategy->mutate($annotations, $match);
                }
            }
        }
        return $annotations;
    }
}
