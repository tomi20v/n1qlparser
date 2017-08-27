<?php

namespace tomi20v\n1qlparser\Annotation\Strategy;

use tomi20v\n1qlparser\Annotation\PropertyAnnotations;
use tomi20v\n1qlparser\Annotation\StrategyInterface;

class TokenTypeAnnotation implements StrategyInterface
{

    const KEYWORD = 'tokenType';

    public function mutate(PropertyAnnotations $annotation, $result)
    {
        $results = explode('|', $result);
        foreach ($results as $eachResult) {
            $annotation->tokenType[] = $eachResult;
        }
    }

}
