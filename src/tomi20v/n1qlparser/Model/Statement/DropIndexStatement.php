<?php

namespace tomi20v\n1qlparser\Model\Statement;

class DropIndexStatement
{

    /**
     * @tokenType statement
     * @pattern drop index
     */
    public $statement;

    /**
     * @optional
     * @as Meta\NamedKeyspaceRef
     */
    public $namespaceRef;

    /**
     * @pattern [a-zA-Z][a-zA-Z0-9#_]*
     */
    public $indexName;

    /**
     * @optional
     * @as Model\Statement\Partial\UsingGsiOrView
     */
    public $usingGsiOrView;

}
