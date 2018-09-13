<?php

use MapaDirectSDK\Wrappers\MDApiWrapperSetShippingProduct;
use PHPUnit\Framework\TestCase;

class MDApiWrapperSetShippingProductTest extends TestCase
{

    public function testSetGet()
    {
        $wrapper = new MDApiWrapperSetShippingProduct();
        $wrapper->setId(123);
        $this->assertEquals('/products/123', $wrapper->getURI());
        $this->assertEquals('PUT', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

        $data = 'test';
        $wrapper->setInput($data);
        $this->assertEquals($wrapper->getInput(), $data);
    }


    public function testCheck()
    {
        $wrapper = new MDApiWrapperSetShippingProduct();
        $this->assertFalse($wrapper->check());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertFalse($wrapper->check());
        $wrapper->setId(123);
        $this->assertTrue($wrapper->check());
    }
}
