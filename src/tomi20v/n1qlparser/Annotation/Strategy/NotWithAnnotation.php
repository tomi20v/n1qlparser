<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class NotWithAnnotation implements StrategyInterface
{

    const KEYWORD = 'notWith';

    public function mutate(PropertyAnnotations $annotation, $result)
    {
        $results = explode('|', $result);
        foreach ($results as $eachResult) {
            $annotation->notWith[] = $eachResult;
        }
    }

}
