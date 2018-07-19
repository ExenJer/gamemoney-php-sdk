<?php
namespace tests;

use Gamemoney\Exception\ValidationException;
use PHPUnit\Framework\TestCase;
use Gamemoney\Validation\Validator;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;


class ValidatorTest extends TestCase
{
    public function successValidateProvider()
    {
        return [
            ['rules' => [], 'data' => []],
            [
                'rules' => [
                    'param1' => [new NotBlank()],
                    'param2' => [new NotBlank()],
                    'param3' => [new NotBlank()],
                ],
                'data' => [
                    'param1' => 'test',
                    'param2' => '0',
                    'param3' => 0
                ]
            ],
            [
                'rules' => [
                    'param1' => [new Type('string'), new Length(4)],
                    'param2' => [new Type('string'), new Length(['max' => 3])],
                    'param3' => [new Type('string'), new Length(['min' => 5])],
                    'param4' => [new Type('string')],
                    'param5' => [new Length(4)],
                ],
                'data' => [
                    'param1' => 'aaaa',
                    'param2' => 'a',
                    'param3' => 'aaaaa',
                    'param4' => null,
                    'param5' => null,
                ]
            ],
            [
                'rules' => [
                    'param1' => [new Type('scalar')],
                    'param2' => [new Type('scalar')],
                    'param3' => [new Type('scalar')],
                    'param4' => [new Type('scalar')],
                ],
                'data' => [
                    'param1' => 'string',
                    'param2' => 1,
                    'param3' => false,
                    'param4' => 4.1,
                ]
            ],
        ];
    }

    /**
     * @param $rules
     * @param $data
     * @dataProvider successValidateProvider
     */
    public function testSuccessValidate($rules, $data)
    {
        $validator = new Validator;
        $this->assertTrue($validator->validate($rules, $data));
    }

    public function failValidateProvider()
    {
        return [
            [
                'rules' => [
                    'param1' => [new NotBlank()],
                    'param2' => [new NotBlank()]
                ],
                'data' => ['param1' => 'test']
            ],
            ['rules' => ['param' => [new NotBlank()]], 'data' => ['param' => '']],
            ['rules' => ['param' => [new NotBlank()]], 'data' => ['param' => null]],
            ['rules' => ['param' => [new NotBlank()]], 'data' => ['param' => false]],
            ['rules' => ['param' => [new NotBlank()]], 'data' => []],
        ];
    }

    /**
     * @param $rules
     * @param $data
     * @dataProvider failValidateProvider
     */
    public function testFailValidate($rules, $data)
    {
        $validator = new Validator;
        $this->expectException(ValidationException::class);
        $validator->validate($rules, $data);
    }
}
