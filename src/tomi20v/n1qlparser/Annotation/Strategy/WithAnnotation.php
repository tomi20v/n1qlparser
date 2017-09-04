<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class WithAnnotation implements StrategyInterface
{

    const KEYWORD = 'with';

    public function mutate(PropertyAnnotation $annotation, $result)
    {
        $annotation->with[] = $result;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
