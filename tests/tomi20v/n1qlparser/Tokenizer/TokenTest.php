<?php

namespace tomi20v\n1qlchecker\Tokenizer;

use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{

    /** @var string  */
    private $anyType = 'anyType';
    /** @var string  */
    private $anyContent = 'any content';

    public function testShouldConstruct()
    {
        $token = new Token(
            $this->anyType,
            $this->anyContent
        );
        $this->assertEquals($this->anyType, $token->type);
        $this->assertEquals($this->anyContent, $token->content);
    }

}
