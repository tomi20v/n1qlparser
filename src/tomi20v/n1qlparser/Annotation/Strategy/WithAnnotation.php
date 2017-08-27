<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class WithAnnotation implements StrategyInterface
{

    const KEYWORD = 'with';

    public function mutate(PropertyAnnotations $annotation, $result)
    {
        $results = explode('|', $result);
        foreach ($results as $eachResult) {
            $annotation->with[] = $eachResult;
        }
    }

}
