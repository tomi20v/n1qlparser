<?php

use tomi20v\n1qlparser\Service\LexerFactory;
use tomi20v\n1qlparser\Service\LexerService;

require(__DIR__ . '/../vendor/autoload.php');

$exampleN1qls = [
    'SELECT *, null, true, false',
    'SELECT 1, 1.1, 1e2, 1e-2, -1e2, -1e-2, - 1e2',
    'SELECT "abc", \'abc\', "ab\"cd", \'ab\"c\\\'d\'',
    'distinct',
    'any every array first exists in within satisfies end',
    'SELECT 1=1, 1==2, 1!=2, 1<>2, 1>2, 1>=2, 1<2, 1<=2',
    'SELECT 1 between [1,2], 1 not between [1,2], 1 like 2, 1 not like 2, 1 is null, 1 is not null',
    'case when then else',
    'and or not',
    'SELECT {"a": 1}, [1, 2, 3], {"a": 1}."a"',
    '"x" || "y"',
    'array_append array_avg array_concat array_contains array_count array_distinct() array_ifnull array_length',
    'array_max array_min array_position array_prepend array_put array_range array_remove array_repeat',
    'array_replace array_reverse array_sort array_sum array_star',
    'greatest least',
    'ifmissing ifmissingornull ifnull missingif nullif',
    'ifinf ifnan ifnanorinf nanif neginfif posinfif',
    'clock_millis clock_str',
    'date_add_millis date_add_str date_diff_millis date_diff_str date_part_millis date_trunc_millis date_trunc_str',
    'decode_json encode_json encoded_size poly_length',
    'base64 base64_encode base64_decode meta uuid',
    'abs acos asin atan atan2 ceil cos degrees e exp ln log floor pi power radians random round sign sin sqrt tan trunc',
    'object_length object_names object_pairs object_values',
    'regexp_contains regexp_like regexp_position regexp_replace',
    'contains initcap length lower ltrim position repeat replace rtrim split substr title trim upper',
    'isarray isatom isboolean isnumber isobject isstring type toarray toatom toboolean tonumber toobject tostring',
    'BUILD INDEX ON `beer-sample`(`beer-sample-type-index`) USING GSI;',
    'CREATE INDEX id_ix on `beer-sample`(meta().id);',
    'CREATE INDEX over5 ON `beer-sample`(abv) WHERE abv > 5 USING GSI WITH {"nodes": ["192.0.2.1:8091"]};',
    'CREATE INDEX `beer-sample-type-index` ON `beer-sample`(type) USING GSI;',
    'CREATE INDEX `beer-sample-type-index` ON `beer-sample`(type) USING GSI WITH {"defer_build":true};',
    'CREATE PRIMARY INDEX `beer-sample-primary-index` ON `beer-sample` USING GSI;',
    'DELETE FROM product p USE KEYS "product10" RETURNING p',
    'DELETE FROM product p WHERE p.unitPrice = 5.25 RETURNING p.productId',
    'DROP INDEX `beer-sample`.`beer-sample-type-index` USING GSI;',
    'DROP PRIMARY INDEX ON `beer-sample` USING GSI;',
    'EXPLAIN SELECT title, genre, runtime FROM catalog.details ORDER BY title',
    'INSERT INTO product (KEY, VALUE) VALUES ("odwalla-juice1", 
        { "productId": "odwalla-juice1", "unitPrice": 4.40, "type": "product", "color":"green"}) RETURNING * ',
    'MERGE INTO product p USING orders o ON KEY o.productId
        WHEN MATCHED THEN
             UPDATE SET p.lastSaleDate = o.orderDate
        WHEN MATCHED THEN
             DELETE WHERE p.inventoryCount  <= 0',
    'UPDATE tutorial t USE KEYS "dave" UNSET c.gender FOR c IN children END RETURNING t',
];

$factory = new LexerFactory();
$config = $factory->createConfig();
$service = new LexerService($config);

foreach ($exampleN1qls as $eachN1ql) {
    $result = $service->tokenize($eachN1ql);
    echo "\n\n" . $eachN1ql . "\n" . print_r($result, 1) . "\n";
}

echo "...DONE\n";
