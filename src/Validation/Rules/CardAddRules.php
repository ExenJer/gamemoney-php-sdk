<?php

namespace Gamemoney\Validation\Rules;

use Gamemoney\Validation\RulesInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

final class CardAddRules implements RulesInterface
{
    public function getRules()
    {
        return [
            'project' => [
                new NotBlank(),
                new Type('numeric')
            ],
            'rand' => [
                new NotBlank(),
                new Length(['min' => 20])
            ],
            'user' => [
                new NotBlank(),
                new Type('numeric')
            ],
            'redirect' => [
                new NotBlank(),
                new Type('string')
            ],
        ];
    }
}