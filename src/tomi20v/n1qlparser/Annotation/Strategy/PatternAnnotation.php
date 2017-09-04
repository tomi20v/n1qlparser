<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class PatternAnnotation implements StrategyInterface
{

    const KEYWORD = 'pattern';

    public function mutate(PropertyAnnotation $annotation, $result)
    {
        $annotation->pattern[] = $result;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
