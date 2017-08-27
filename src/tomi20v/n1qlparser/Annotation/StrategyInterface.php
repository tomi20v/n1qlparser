<?php

namespace tomi20v\n1qlparser\Annotation;

interface StrategyInterface
{
    public function mutate(PropertyAnnotations $annotation, $result);
}
