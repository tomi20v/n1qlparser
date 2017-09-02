<?php

namespace tomi20v\n1qlparser\Lexer;

use Tmilos\Lexer\Token;

class TokenProcessor
{

    public function preProcessTokens(array $tokens): array
    {
        $result = [];
        foreach ($tokens as $eachToken) {
            $result[] = $this->preProcess($eachToken);
        }
        return $result;
    }

    private function preProcess(Token $eachToken)
    {
        switch ($eachToken->getName()) {
        case 'data/string':
            $value = substr($eachToken->getValue(), 1, -1);
            break;
        default:
            $value = $eachToken->getValue();
        }
        return new Token(
            $eachToken->getName(),
            $value,
            $eachToken->getOffset(),
            $eachToken->getPosition()
        );
    }

}
