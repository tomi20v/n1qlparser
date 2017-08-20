<?php

use mindplay\annotations\AnnotationCache;
use mindplay\annotations\Annotations;

Annotations::$config['cache'] = new AnnotationCache(__DIR__ . '/../cache');

//Package::register(Annotations::getManager());
$manager = Annotations::getManager();
$manager->registry['as'] = 'tomi20v\n1qlparser\Annotations\AsAnnotation';
$manager->registry['pattern'] = 'tomi20v\n1qlparser\Annotations\PatternAnnotation';
$manager->registry['optional'] = 'tomi20v\n1qlparser\Annotations\OptionalAnnotation';
$manager->registry['either'] = 'tomi20v\n1qlparser\Annotations\EitherAnnotation';
