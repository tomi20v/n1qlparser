<?php

use tomi20v\n1qlparser\Annotation\AnnotationManager;
use tomi20v\n1qlparser\Lexer\TokenProcessor;
use tomi20v\n1qlparser\Model\Meta\NamedKeyspaceRef;
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
    new AnnotationManager(),
    new StrategyFactory()
);
$tokenProcessor = new TokenProcessor();
$builder = new StatementFactoryService(
    $statementFactory,
    $tokenProcessor
);

$sql = '`any-sample`.`any-index`;';
$sql = '`any-namespace`:`any-keyspace`.`any-index`;';
$sql = '`any-namespace`:`any-keyspace`';
//$sql = '`any-keyspace`;';
$tokens = $tokenProcessor->preProcessTokens($service->tokenize($sql));
print_r($tokens);
$node = new NamedKeyspaceRef();
$result = $statementFactory->build($tokens, $node);
print_r($result);

echo "...DONE\n";
