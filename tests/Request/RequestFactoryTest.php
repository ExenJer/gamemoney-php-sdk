<?php
namespace tests\Request;

use PHPUnit\Framework\TestCase;
use Gamemoney\Request\RequestInterface;
use Gamemoney\Request\RequestFactory;

class RequestFactoryTest extends TestCase
{
    /**
     * @return array
     */
    public function methodDataProvider()
    {
        return [
            [
                'createInvoice',
                [
                    ['amount' => 100]
                ],
                RequestInterface::INVOICE_CREATE_ACTION,
                [
                    'amount' => 100
                ],
            ],
            [
                'getInvoiceStatus',
                [
                    1
                ],
                RequestInterface::INVOICE_STATUS_ACTION,
                [
                    'invoice' => 1
                ],
            ],
            [
                'getInvoiceStatusByExternalId',
                [
                    'external_id'
                ],
                RequestInterface::INVOICE_STATUS_ACTION,
                [
                    'project_invoice' => 'external_id'
                ],
            ],
            [
                'getInvoiceList',
                [
                    [
                        'start' => '2018-10-01 12:10:05',
                        'finish' => '2018-10-30 12:00:00'
                    ]
                ],
                RequestInterface::INVOICE_LIST_ACTION,
                [
                    'start' => '2018-10-01 12:10:05',
                    'finish' => '2018-10-30 12:00:00'
                ],
            ],
            [
                'createCheckout',
                [
                    ['amount' => 100]
                ],
                RequestInterface::CHECKOUT_CREATE_ACTION,
                [
                    'amount' => 100
                ],
            ],
            [
                'cancelCheckout',
                [
                    1
                ],
                RequestInterface::CHECKOUT_CANCEL_ACTION,
                [
                    'projectId' => 1
                ],
            ],
            [
                'getCheckoutStatus',
                [
                    1
                ],
                RequestInterface::CHECKOUT_STATUS_ACTION,
                [
                    'projectId' => 1
                ],
            ],
            [
                'getCheckoutList',
                [
                    [
                        'start' => '2018-10-01 12:10:05',
                        'finish' => '2018-10-30 12:00:00'
                    ]
                ],
                RequestInterface::CHECKOUT_LIST_ACTION,
                [
                    'start' => '2018-10-01 12:10:05',
                    'finish' => '2018-10-30 12:00:00'
                ],
            ],
            [
                'addCard',
                [
                    ['user' => 1]
                ],
                RequestInterface::CARD_ADD_ACTION,
                [
                    'user' => 1
                ],
            ],
            [
                'getCardList',
                [
                    1
                ],
                RequestInterface::CARD_LIST_ACTION,
                [
                    'user' => 1
                ],
            ],
            [
                'deleteCard',
                [
                    ['pan' => '1111****3333']
                ],
                RequestInterface::CARD_DELETE_ACTION,
                [
                    'pan' => '1111****3333'
                ],
            ],
            [
                'prepareExchange',
                [
                    ['amount' => 100]
                ],
                RequestInterface::EXCHANGE_PREPARE_ACTION,
                [
                    'amount' => 100
                ],
            ],
            [
                'convertExchange',
                [
                    ['amount' => 100]
                ],
                RequestInterface::EXCHANGE_CONVERT_ACTION,
                [
                    'amount' => 100
                ],
            ],
            [
                'fastConvertExchange',
                [
                    ['amount' => 100]
                ],
                RequestInterface::EXCHANGE_FAST_CONVERT_ACTION,
                [
                    'amount' => 100
                ],
            ],
            [
                'getExchangeInfo',
                [
                    ['amount' => 100]
                ],
                RequestInterface::EXCHANGE_INFO_ACTION,
                [
                    'amount' => 100
                ],
            ],
            [
                'getExchangeStatus',
                [
                    1
                ],
                RequestInterface::EXCHANGE_STATUS_ACTION,
                [
                    'id' => 1
                ],
            ],
            [
                'getExchangeStatusByExternalId',
                [
                    'external_id'
                ],
                RequestInterface::EXCHANGE_STATUS_ACTION,
                [
                    'externalId' => 'external_id'
                ],
            ],
            [
                'getBalanceStatistics',
                [
                    'RUB'
                ],
                RequestInterface::STATISTICS_BALANCE_ACTION,
                [
                    'currency' => 'RUB'
                ],
            ],
            [
                'getDaysBalanceStatistics',
                [
                    [
                        'currency' => 'RUB',
                        'start' => '2018-10-01',
                        'finish' => '2018-10-30'
                    ]
                ],
                RequestInterface::STATISTICS_DAYS_BALANCE_ACTION,
                [
                    'currency' => 'RUB',
                    'start' => '2018-10-01',
                    'finish' => '2018-10-30'
                ],
            ],
            [
                'getPayTypesStatistics',
                [],
                RequestInterface::STATISTICS_PAY_TYPES_ACTION,
                [],
            ],
        ];
    }

    /**
     * @param string $method
     * @param array $args
     * @param string $action
     * @param array $expectedData
     * @dataProvider methodDataProvider
     */
    public function testMethods($method, array $args, $action, array $expectedData)
    {
        $request = call_user_func_array([RequestFactory::class, $method], $args);
        $this->assertInstanceOf(RequestInterface::class, $request);
        $this->assertEquals($request->getAction(), $action);
        $requestData = $request->getData();
        unset($requestData['rand']);
        $this->assertEquals($requestData, $expectedData);
    }
}
