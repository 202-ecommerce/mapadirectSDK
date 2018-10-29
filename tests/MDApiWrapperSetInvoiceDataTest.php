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

        $wrapper = new MDApiWrapperSetInvoiceData();
        $wrapper->setId(123);
        $siret = '52807584900042';
        $wrapper->setSiret($siret);
        $this->assertEquals($wrapper->getSiret(), $siret);

        $data = array(
            'invoiceNumber' => "132465",
            'invoiceDate' => "2018-06-07T17:56:00.000Z",
        );

        $wrapper->setInput($data);
        $this->assertEquals($wrapper->getInput(), $data);
    }


    public function testCheck()
    {
        $wrapper = new MDApiWrapperSetInvoiceData();
        $this->assertFalse($wrapper->check());

        $wrapper = new MDApiWrapperSetInvoiceData();
        $siret = '52807584900042';
        $wrapper->setSiret($siret);
        $wrapper->setId(123);
        $data = array(
            'invoiceNumber' => "132465",
            'invoiceDate' => "2018-06-07T17:56:00.000Z",
        );
        $wrapper->setInput($data);
        $this->assertTrue($wrapper->check());

        $data['invoiceNumber'] = "";
        $data['invoiceDate'] = "2018-06-07T17:56:00";
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());

    }
}
