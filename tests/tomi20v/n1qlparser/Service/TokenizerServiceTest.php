<?php

namespace tomi20v\n1qlchecker\Service;

use PHPUnit\Framework\TestCase;
use tomi20v\n1qlchecker\Tokenizer\Tokenizer;

class TokenizerServiceTest extends TestCase
{

    /** @var Tokenizer|\PHPUnit_Framework_MockObject_MockObject */
    private $tokenizer;
    /** @var TokenizerService */
    private $service;

    private $anyString = 'any string';

    public function setUp()
    {
        $this->tokenizer = $this->getMockBuilder(Tokenizer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->service = new TokenizerService(
            $this->tokenizer
        );
    }

    public function testTokenizeShouldProxy()
    {
        $anyArray = [];
        $this->tokenizer
            ->expects($this->once())
            ->method('tokenize')
            ->with($this->anyString)
            ->willReturn($anyArray);
        $result = $this->service->tokenize($this->anyString);
        $this->assertSame($anyArray, $result);
    }

}
