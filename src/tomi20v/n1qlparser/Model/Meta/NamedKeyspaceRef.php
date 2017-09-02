<?php

namespace tomi20v\n1qlparser\Model\Meta;

class NamedKeyspaceRef
{

    /**
     * @tokenType data/string
     * @pattern [a-zA-Z][a-zA-Z0-9#_\-]*
     * @suffix colon
     * @optional
     */
    public $namespaceName;
    /**
     * @tokenType operator/colon
     * @optional
     */
    public $colon;
    /**
     * @tokenType data/string
     * @pattern [a-zA-Z][a-zA-Z0-9#_\-]*
     */
    public $keyspaceName;

}
