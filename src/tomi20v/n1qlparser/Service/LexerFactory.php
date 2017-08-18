<?php

namespace tomi20v\n1qlparser\Service;

use Tmilos\Lexer\Config\LexerArrayConfig;
use Tmilos\Lexer\Lexer;

class LexerFactory
{

    const PATTERNS = [
//        'ALL',
        'ALTER',
        'ANALYZE',
        'AND',
//        'ANY',
//        'ARRAY',
//        'AS',
        'ASC',
        'BEGIN',
//        'BETWEEN',
        'BINARY',
        'BOOLEAN',
        'BREAK',
        'BUCKET',
//        'BY',
        'CALL',
//        'CASE',
        'CAST',
        'CLUSTER',
        'COLLATE',
        'COLLECTION',
        'COMMIT',
        'CONNECT',
        'CONTINUE',
        'CORRELATE',
//        'CREATE',
        'DATABASE',
        'DATASET',
        'DATASTORE',
        'DECLARE',
//        'DELETE',
        'DERIVED',
        'DESC',
        'DESCRIBE',
//        'DISTINCT',
        'DO',
//        'DROP',
        'EACH',
//        'ELEMENT',
//        'ELSE',
//        'END',
//        'EVERY',
//        'EXCEPT',
        'EXCLUDE',
        'EXECUTE',
//        'EXISTS',
//        'EXPLAIN',
//        'FALSE',
//        'FIRST',
//        'FLATTEN',
//        'FOR',
//        'FROM',
        'FUNCTION',
        'GRANT',
//        'GROUP',
//        'GSI',
//        'HAVING',
        'IF',
//        'IN',
        'INCLUDE',
//        'INDEX',
        'INLINE',
//        'INNER',
//        'INSERT',
//        'INTERSECT',
//        'INTO',
        'IS',
//        'JOIN',
//        'KEY',
//        'KEYS',
        'KEYSPACE',
        'LAST',
//        'LEFT',
//        'LET',
//        'LETTING',
//        'LIKE',
//        'LIMIT',
        'LSM',
        'MAP',
        'MAPPING',
//        'MATCHED',
        'MATERIALIZED',
//        'MERGE',
        'MINUS',
//        'MISSING',
        'NAMESPACE',
//        'NEST',
//        'NOT',
//        'NULL',
        'NUMBER',
//        'OFFSET',
//        'ON',
        'OPTION',
        'OR',
        'ORDER',
//        'OUTER',
        'OVER',
        'PARSE',
        'PARTITION',
        'PASSWORD',
        'PATH',
        'POOL',
//        'PREPARE',
//        'PRIMARY',
        'PRIVATE',
        'PRIVILEGE',
        'PROCEDURE',
        'PUBLIC',
//        'RAW',
        'REALM',
        'REDUCE',
        'RENAME',
        'RETURN',
        'RETURNING',
        'REVOKE',
        'RIGHT',
        'ROLE',
        'ROLLBACK',
//        'SATISFIES',
        'SCHEMA',
        'SELECT',
        'SELF',
//        'SET',
        'SHOW',
        'SOME',
        'START',
        'STATISTICS',
        'STRING',
        'SYSTEM',
//        'THEN',
        'TO',
        'TRANSACTION',
        'TRIGGER',
//        'TRUE',
        'TRUNCATE',
        'UNDER',
//        'UNION',
//        'UNIQUE',
//        'UNNEST',
//        'UNSET',
//        'UPDATE',
//        'UPSERT',
//        'USE',
        'USER',
//        'USING',
        'VALIDATE',
//        'VALUE',
//        'VALUED',
//        'VALUES',
//        'VIEW',
//        'WHEN',
//        'WHERE',
        'WHILE',
//        'WITH',
//        'WITHIN',
        'WORK',
        'XOR',
    ];

    public function createConfig()
    {
//        var $D = '';
        return new LexerArrayConfig([
            // whitespace, trailing semicolon
            '\\s' => '',
            ';\\s*' => '',

            // data
            '\\*' => 'data/star',
            'null\b' => 'data/null',
            '(true|false)\b' => 'data/boolean',
            '\-?\s*\d+e\-?\d+' => 'data/number',
            '\d(\.\d*)?' => 'data/number',
            '(\'|"|`)(?:[^\1\\\\]|\\\\.)*?\1' => 'data/string',

            // reserved
            ',' => 'reserved/comma',
            '\(' => 'reserved/parentheses/start',
            '\)' => 'reserved/parentheses/end',
            'end\b' => 'reserved/end',

            'all\b' => 'statement/partial/as',
            'as\b' => 'statement/partial/as',
            'distinct\b' => 'statement/partial/distinct',
            'element\b' => 'statement/partial/element',
            'except\b' => 'statement/partial/except',
            'flatten\b' => 'statement/partial/flatten',
            'for\b' => 'statement/partial/for',
            'from\b' => 'statement/partial/from',
            'group\s+by\b' => 'statement/partial/groupBy',
            'having\b' => 'statement/partial/having',
            'intersect\b' => 'statement/partial/intersect',
            'in\b' => 'statement/partial/in',
            'inner\b' => 'statement/partial/inner',
            'into\b' => 'statement/partial/into',
            'join\b' => 'statement/partial/join',
            'key\b' => 'statement/partial/key',
            'left\b' => 'statement/partial/left',
            'let\b' => 'statement/partial/let',
            'letting\b' => 'statement/partial/letting',
            'limit\b' => 'statement/partial/limit',
            'nest\b' => 'statement/partial/nest',
            'offset\b' => 'statement/partial/offset',
            'on\b' => 'statement/partial/on',
            'on\s+primary\s+keys\b' => 'statement/partial/on',
            'order\s+by\b' => 'statement/partial/orderBy',
            'outer\b' => 'statement/partial/outer',
            'raw\b' => 'statement/partial/raw',
            'returning\b' => 'statement/partial/returning',
            'set\b' => 'statement/partial/set',
            'use\s+(primary\s+)?keys\b' => 'statement/partial/useKeys',
            'union\b' => 'statement/partial/union',
            'unnest\b' => 'statement/partial/unnest',
            'unset\b' => 'statement/partial/unset',
            'using\s+gsi\b' => 'statement/partial/usingGsi',
            'using\b' => 'statement/partial/using',
            'value\b' => 'statement/partial/value',
            'values\b' => 'statement/partial/values',
            'view\b' => 'statement/partial/view',
            'when\s+matched\s+then\s+update\b' => 'statement/partial/whenMatchedThen/update',
            'when\s+matched\s+then\s+delete\b' => 'statement/partial/whenMatchedThen/delete',
            'when\s+not\s+matched\s+then\s+insert\b' => 'statement/partial/whenNotMatchedThen/insert',
            'where\b' => 'statement/partial/where',
            'with\b' => 'statement/partial/with',
            'within\b' => 'statement/partial/within',


            // operators
            '(any|every|array|first|exists|in|within)\b' => 'operator/collection',
            'satisfies\b' => 'operator/collection/satisfies',
            '(==|=|!=|<>|>=|>|<=|<)' => 'operator/comparison',
            '((not\s+)?between)\b' => 'operator/comparison',
            '((not\s+)?like)\b' => 'operator/comparison',
            '(is\s+(not\s+)?null)\b' => 'operator/comparison',
            '(is\s+(not\s+)?missing)\b' => 'operator/comparison',
            '(is\s+(not\s+)?valued)\b' => 'operator/comparison',
            '(case|when|then|else)\b' => 'operator/conditional/case',
////            '\[' => 'operator/construction/array/begin',
////            '\]' => 'operator/construction/array/end',
            '(and|or|not)\b' => 'operator/logical',
            '\{' => 'operator/construction/object/begin',
            '\:' => 'operator/colon',
            '\}' => 'operator/construction/object/end',
            '\.' => 'operator/field',
            '\[' => 'operator/array/begin',
            '\]' => 'operator/array/end',
            '\|\|' => 'operator/string/concatenate',

            // functions
            '(array_agg|avg|count|max|min|sum)\b' => 'function/aggregate',
            '(array_(append|avg|concat|contains|count|distinct|ifnull|length|' .
                'max|min|position|prepend|put|range|remove|repeat|replace|' .
                'reverse|sort|sum|star))\b' => 'function/array',
            '(greatest|least)\b' => 'function/comparison',
            '(ifmissing|ifmissingornull|ifnull|missingif|nullif)\b' => 'function/conditional/missing',
            '(ifinf|ifnan|ifnanorinf|nanif|neginfif|posinfif)\b' => 'function/conditional/number',
            '(clock_(millis|str))\b' => 'function/date',
            '(date_(add_millis|add_str|diff_millis|diff_str|part_millis|' .
                'part_str|trunc_millis|trunc_str))\b' => 'function/date',
            '(duration_to_str|millis)\b' => 'function/date',
            '(millis_(to_str|to_utc|to_zone_name))\b' => 'function/date',
            '(now_(millis|str))\b' => 'function/date',
            '(str_(to_duration|to_millis|to_utc|to_zone_name))\b' => 'function/date',
            '(decode_json|encode_json|encoded_size|poly_length)\b' => 'function/json',
            '(base64|base64_encode|base64_decode|meta|uuid)\b' => 'function/meta',
            '(abs|acos|asin|atan|atan2|ceil|cos|degrees|e|' .
                'exp|ln|log|floor|pi|power|radians|random|' .
                'round|sign|sin|sqrt|tan|trunc)\b' => 'function/number',
            '(object_(length|names|pairs|values))\b' => 'function/object',
            '(regexp_(contains|like|position|replace))\b' => 'function/pattern',
            '(contains|initcap|length|lower|ltrim|position|repeat|replace|rtrim|' .
                'split|substr|title|trim|upper)\b' => 'function/string',
            '(isarray|isatom|isboolean|isnumber|isobject|isstring|type|toarray|' .
                'toatom|toboolean|tonumber|toobject|tostring)\b' => 'function/type',

            // statements
            '(build\s+index|create\s+index|create\s+primary\s+index|delete|drop index|' .
                'drop\s+primary\s+index|explain|insert|merge|prepare|select|update|' .
                'upsert)\b' => 'statement',

            // expression
            '[\w]+\b' => 'expression',

        ]);
    }

    public function createLexer() {
        $lexer = new Lexer($this->createConfig());
        return $lexer;
    }

}