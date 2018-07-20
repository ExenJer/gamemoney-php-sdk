<?php
namespace tests\Request;

use PHPUnit\Framework\TestCase;
use Gamemoney\Request\Request;
use Gamemoney\Request\RequestInterface;


class RequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new Request('/test', ['data' => 1, 'rand' => 'test']);
        $this->assertEquals($request->getAction(), '/test');
        $this->assertEquals($request->getData(), ['data' => 1, 'rand' => 'test']);
    }

    public function testEmptyRandConstructor()
    {
        $request = new Request('/test', ['data' => 1]);
        $data = $request->getData();
        $this->assertArrayHasKey('rand', $data);
        $this->assertTrue(is_string($data['rand']));
        $this->assertGreaterThanOrEqual(20, strlen($data['rand']));
    }

    public function testSetData()
    {
        $request = new Request('/test');
        $this->assertInstanceOf(
            RequestInterface::class,
            $request->setData(['data' => 1, 'rand' => 'test'])
        );
        $this->assertEquals($request->getData(), ['data' => 1, 'rand' => 'test']);
    }

    public function testField()
    {
        $request = new Request('/test');
        $this->assertInstanceOf(
            RequestInterface::class,
            $request->setField('data', 1)
        );
        $this->assertEquals($request->getField('data'), 1);
    }
}
