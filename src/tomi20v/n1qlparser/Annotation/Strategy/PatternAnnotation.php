<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class PatternAnnotation implements StrategyInterface
{

    const KEYWORD = 'pattern';

    public function mutate(PropertyAnnotations $annotation, $result)
    {
        $annotation->pattern[] = $result;
    }

}
