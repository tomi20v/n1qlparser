<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class AsAnnotation implements StrategyInterface
{

    const KEYWORD = 'as';

    public function mutate(PropertyAnnotation $annotations, $result)
    {
        $annotations->as[] = $result;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
