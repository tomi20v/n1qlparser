<?php

use tomi20v\n1qlparser\Annotation\AnnotationManager;
use tomi20v\n1qlparser\Annotation\PropertyAnnotationsFactory;
use tomi20v\n1qlparser\Lexer\TokenProcessor;
use tomi20v\n1qlparser\Model\Meta\NamedKeyspaceRef;
use tomi20v\n1qlparser\Model\Statement\DropIndexStatement;
use tomi20v\n1qlparser\Service\LexerFactory;
use tomi20v\n1qlparser\Service\LexerService;
use tomi20v\n1qlparser\Service\StatementFactoryService;
use tomi20v\n1qlparser\Statement\StatementFactory;
use tomi20v\n1qlparser\Statement\StrategyFactory;

require(dirname(__FILE__) . '/../vendor/autoload.php');

$exampleN1qls = [
    'DROP INDEX `any-sample`.`any-index`;',
//    'DROP INDEX `anyNamespace`:`any-sample`.`any-index` USING GSI;',
//    'DROP PRIMARY INDEX ON `beer-sample` USING GSI;',
];

$factory = new LexerFactory();
$config = $factory->createConfig();
$service = new LexerService($config);
$statementFactory = new StatementFactory(
    new AnnotationManager(
        new PropertyAnnotationsFactory()
    ),
    new StrategyFactory()
);
$tokenProcessor = new TokenProcessor();
$builder = new StatementFactoryService(
    $statementFactory,
    $tokenProcessor
);

$sql = '`any-sample`.`any-index`;';
$sql = '`any-namespace`:`any-keyspace`.`any-index`;';

//$sql = '`any-namespace`:`any-keyspace`';
////$sql = '`any-keyspace`;';
//$node = new NamedKeyspaceRef();
//$tokens = $tokenProcessor->preProcessTokens($service->tokenize($sql));
//print_r($tokens);
//$result = $statementFactory->build($tokens, $node);
//print_r($result);

$sql = 'DROP INDEX `any-namespace`:`any-keyspace`.`any-index`;';
$node = new DropIndexStatement();
$tokens = $tokenProcessor->preProcessTokens($service->tokenize($sql));
print_r($tokens);
$result = $statementFactory->build($tokens, $node);
print_r($result);

echo "...DONE\n";
