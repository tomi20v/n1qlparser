<?php

namespace tomi20v\n1qlparser\Model\Meta;

class NamedKeyspaceRef
{

    /**
     * @optional
     * @pattern [a-zA-Z][a-zA-Z0-9#_]*
     * @with colon
     */
    public $namespaceName;
    /**
     * @tokenType operator/colon
     * @with namespaceName
     */
    public $colon;
    /**
     * @required
     * @pattern [a-zA-Z][a-zA-Z0-9#_]*
     */
    public $keyspaceName;

}
