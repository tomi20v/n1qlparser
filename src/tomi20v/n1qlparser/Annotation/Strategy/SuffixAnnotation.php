<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class SuffixAnnotation implements StrategyInterface
{

    const KEYWORD = 'suffix';

    public function mutate(PropertyAnnotations $annotation, $result)
    {
        $annotation->suffix[] = $result;
    }

}
