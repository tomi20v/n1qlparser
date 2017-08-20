<?php

namespace tomi20v\n1qlparser\Model\Meta;

class NamedKeyspaceRef
{

    /**
     * @optional
     * @pattern [a-zA-Z][a-zA-Z0-9#_]*
     * @requires colon
     */
    public $namespaceName;
    /**
     * @exactly operator/colon
     */
    public $colon;
    /**
     * @required
     * @pattern [a-zA-Z][a-zA-Z0-9#_]*
     */
    public $keyspaceName;

}
