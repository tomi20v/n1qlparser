<?php

namespace tomi20v\n1qlparser\Annotation;

interface StrategyInterface
{
    public function keyword(): string;
    public function mutate(PropertyAnnotation $annotation, $result);
}
