<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class OptionalAnnotation implements StrategyInterface
{

    const KEYWORD = 'optional';

    public function mutate(PropertyAnnotations $annotation, $result)
    {
        $annotation->required = false;
    }

}
