<?php

namespace Gamemoney\Validation\Rules;

use Gamemoney\Validation\RulesInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Ip;

final class CheckoutCreateRules implements RulesInterface
{
    public function getRules()
    {
        return [
            'project' => [
                new NotBlank(),
                new Type('numeric'),
            ],
            'rand' => [
                new NotBlank(),
                new Length(['min' => 20])
            ],
            'projectId' => [
                new NotBlank(),
                new Type('scalar')
            ],
            'user' => [
                new NotBlank(),
                new Type('numeric'),
            ],
            'amount' => [
                new NotBlank(),
                new Type('numeric'),
            ],
            'wallet' => [
                new Type('string')
            ],
            'description' => [
                new Type('string')
            ],
            'type' => [
                new NotBlank(),
                new Type('string')
            ],
            'currency' => [
                new Type('string'),
                new Length(['max' => 3])
            ],
            'userCurrency' => [
                new Type('string'),
                new Length(['max' => 3])
            ],
            'ip' => [
                new Ip()
            ],
        ];
    }
}