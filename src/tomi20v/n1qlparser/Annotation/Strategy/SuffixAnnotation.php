<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class SuffixAnnotation implements StrategyInterface
{

    const KEYWORD = 'suffix';

    public function mutate(PropertyAnnotation $annotation, $result)
    {
        $annotation->suffix[] = $result;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
