<?php

use MapaDirectSDK\Wrappers\MDApiWrapperSetInvoiceData;
use PHPUnit\Framework\TestCase;

class MDApiWrapperSetInvoiceDataTest extends TestCase
{

    public function testSetGet()
    {
        $wrapper = new MDApiWrapperSetInvoiceData();
        $wrapper->setId(123);
        $this->assertEquals('/orders/123/setinvoicedata', $wrapper->getURI());
        $this->assertEquals('PUT', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

        $data = array(
            'invoiceNumber' => "132465",
            'invoiceDate' => "2018-06-07T17:56:00.000Z",
        );

        $wrapper->setInput($data);
        $this->assertEquals($wrapper->getInput(), $data);
    }


    public function testCheck()
    {
        $wrapper = new \MapaDirectSDK\Wrappers\MDApiWrapperSetInvoiceData();

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $wrapper->setId(123);
        $data = array(
            'invoiceNumber' => "132465",
            'invoiceDate' => "2018-06-07T17:56:00.000Z",
        );
        $wrapper->setInput($data);
        $this->assertTrue($wrapper->check());

        $data['invoiceDate'] = "2018-06-07T17:56:00";
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());

    }
}
