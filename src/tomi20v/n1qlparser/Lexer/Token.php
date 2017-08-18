<?php

namespace tomi20v\n1qlparser\Lexer;

class Token
{

    /** @var string */
    public $type;
    /** @var string */
    public $content;

    public function __construct(string $type, string $content)
    {
        $this->type = $type;
        $this->content = $content;
    }

}
