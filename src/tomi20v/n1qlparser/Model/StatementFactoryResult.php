<?php

namespace tomi20v\n1qlparser\Model;

use Tmilos\Lexer\Token;

class StatementFactoryResult
{

    public $error = false;
    public $statementPart = null;
    /** @var  Token[] */
    public $usedTokens;

    public function isEmpty()
    {
        return is_null($this->statementPart);
    }

}
