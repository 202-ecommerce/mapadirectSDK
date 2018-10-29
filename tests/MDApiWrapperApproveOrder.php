<?php

use MapaDirectSDK\Wrappers\MDApiWrapperApproveOrder;
use PHPUnit\Framework\TestCase;

class MDApiWrapperApproveOrderTest extends TestCase
{

    public function testSetGet()
    {
        $wrapper = new MDApiWrapperApproveOrder();
        $wrapper->setId(123);
        $this->assertEquals('/orders/123', $wrapper->getURI());
        $this->assertEquals('PUT', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

        $this->assertEquals($wrapper->getInput(), array('approved' => true, 'do_not_create_invoice' => true));
    }

}
