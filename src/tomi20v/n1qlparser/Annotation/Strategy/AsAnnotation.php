<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class AsAnnotation implements StrategyInterface
{

    const KEYWORD = 'as';

    public function mutate(PropertyAnnotations $annotations, $result)
    {
        $annotations->as[] = $result;
    }

}
