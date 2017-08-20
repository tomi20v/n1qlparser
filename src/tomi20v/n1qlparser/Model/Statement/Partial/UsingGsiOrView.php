<?php

namespace tomi20v\n1qlparser\Model\Statement\Partial;

class UsingGsiOrView
{

    /**
     * @optional
     * @tokenType statement/partial/usingGsi
     * @notWith view
     */
    public $usingGsi;
    /**
     * @optional
     * @tokenType statement/partial/view
     * @notWith usingGsi
     */
    public $view;

}
