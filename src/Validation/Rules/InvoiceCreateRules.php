<?php

namespace Gamemoney\Validation\Rules;

use Gamemoney\Validation\RulesInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Ip;

final class InvoiceCreateRules implements RulesInterface
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
            'user' => [
                new NotBlank(),
                new Type('numeric'),
            ],
            'amount' => [
                new NotBlank(),
                new Type('numeric'),
            ],
            'type' => [
                new NotBlank(),
                new Type('string')
            ],
            'currency' => [
                new Type('string'),
                new Length(['max' => 3])
            ],
            'user_currency' => [
                new Type('string'),
                new Length(['max' => 3])
            ],
            'language' => [
                new Type('string'),
                new Length(['max' => 2])
            ],
            'project_invoice' => [
                new Type('scalar')
            ],
            'ip' => [
                new Ip()
            ],
        ];
    }
}