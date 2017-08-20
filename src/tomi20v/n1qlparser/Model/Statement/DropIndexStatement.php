<?php

namespace tomi20v\n1qlparser\Model\Statement;

class DropIndexStatement
{

    /**
     * @as Meta\NamedKeyspaceRef
     */
    public $nameSpaceRef;

    /**
     * @pattern [a-zA-Z][a-zA-Z0-9#_]*
     */
    public $indexName;

    /**
     * @optional
     * @either Statement\Partial\UsingGsi|Statement\Partial\View
     */
    public $usingGsiOrView;

}
