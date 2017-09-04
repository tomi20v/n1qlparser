<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class OptionalAnnotation implements StrategyInterface
{

    const KEYWORD = 'optional';

    public function mutate(PropertyAnnotation $annotation, $result)
    {
        $annotation->required = false;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
