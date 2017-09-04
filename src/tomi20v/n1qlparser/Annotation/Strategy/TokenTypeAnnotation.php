<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class TokenTypeAnnotation implements StrategyInterface
{

    const KEYWORD = 'tokenType';

    public function mutate(PropertyAnnotation $annotation, $result)
    {
        $annotation->tokenType[] = $result;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
