<?php

use tomi20v\n1qlparser\Annotation\AnnotationManager;

require_once(__DIR__ . '/../vendor/autoload.php');

$manager = new AnnotationManager();

$className = 'tomi20v\n1qlparser\Model\Statement\DropIndexStatement';

$annotations = $manager->allAnnotationByClass($className);
print_r($annotations);

$className = 'tomi20v\n1qlparser\Model\Meta\NamedKeyspaceRef';

$annotations = $manager->allAnnotationByClass($className);
print_r($annotations);

$className = 'tomi20v\n1qlparser\Model\Statement\Partial\UsingGsiOrView';

$annotations = $manager->allAnnotationByClass($className);
print_r($annotations);

die("OK\n");

