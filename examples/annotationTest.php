<?php

use mindplay\annotations\Annotations;
use tomi20v\n1qlparser\Model\Statement\DropIndexStatement;

require(__DIR__ . '/../vendor/autoload.php');

require('boot.php');

$manager = Annotations::getManager();
$dropIndexStatement = new DropIndexStatement();
$annotation = $manager->getPropertyAnnotations($dropIndexStatement, 'nameSpaceRef');
$annotation = $manager->getPropertyAnnotations($dropIndexStatement, 'indexName');
$annotation = $manager->getPropertyAnnotations($dropIndexStatement, 'usingGsiOrView');

print_r($annotation); die('OK');
