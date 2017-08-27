<?php

namespace tomi20v\n1qlparser\Annotation;

use tomi20v\n1qlparser\Annotation\Strategy\NotWithAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\TokenTypeAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\AsAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\OptionalAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\PatternAnnotation;
use tomi20v\n1qlparser\Annotation\Strategy\WithAnnotation;

class PropertyAnnotationsFactory
{

    /** @var StrategyInterface[] */
    private $strategies;

    public function __construct()
    {
        $this->strategies = [
            new AsAnnotation(),
            new PatternAnnotation(),
            new OptionalAnnotation(),
            new TokenTypeAnnotation(),
            new WithAnnotation(),
            new NotWithAnnotation(),
        ];
    }

    public function fromPhpDoc(string $phpDoc)
    {
        $annotations = new PropertyAnnotations();
        $doc = explode("\n", $phpDoc);
        foreach ($doc as $eachLine) {
            foreach ($this->strategies as $eachStrategy) {
                $pattern = '/\*\s+@' . $eachStrategy::KEYWORD . '(\s+(.+)\s*)?$/';
                if (preg_match($pattern, $eachLine, $matches)) {
                    $match = isset($matches[2]) ? $matches[2] : null;
                    $eachStrategy->mutate($annotations, $match);
                }
            }
        }
        return $annotations;
    }
}
