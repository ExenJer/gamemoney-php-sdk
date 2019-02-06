<?php

namespace Gamemoney\Validation\Request\Rules;

use Gamemoney\Gateway;
use Gamemoney\Validation\Request\RulesInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Class StatisticsDaysBalancesRules
 * @package Gamemoney\Validation\Request\Rules
 */
final class StatisticsDaysBalancesRules implements RulesInterface
{
    /**
     * @inheritdoc
     */
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
            'currency' => [
                new Type('string'),
                new Length(['max' => 3])
            ],
            'start' => [
                new NotBlank(),
                new DateTime(['format' => Gateway::DATETIME_FORMAT]),
            ],
            'finish' => [
                new NotBlank(),
                new DateTime(['format' => Gateway::DATETIME_FORMAT]),
            ],
        ];
    }
}
