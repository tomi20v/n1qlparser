<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotation;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class NotWithAnnotation implements StrategyInterface
{

    const KEYWORD = 'notWith';

    public function mutate(PropertyAnnotation $annotation, $result)
    {
        $annotation->notWith[] = $result;
    }

    public function keyword(): string
    {
        return self::KEYWORD;
    }

}
