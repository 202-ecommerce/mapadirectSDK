<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 *
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright Copyright (c) 202-ecommerce
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

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

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $wrapper->setId('123');

        $productShipping = array(
            "status" => "A",
            "rates" => array(
                array(
                    "amount" => 0,
                    "value" => 3.99

                ), array(
                    "amount" => 1,
                    "value" => 1.99
                )
            )
        );
        $wrapper->setInput($productShipping);
        $this->assertTrue($wrapper->check());

        unset($productShipping['status']);
        $wrapper->setInput($productShipping);
        $this->assertFalse($wrapper->check());

        $productShipping['status'] = "G";
        $wrapper->setInput($productShipping);
        $this->assertFalse($wrapper->check());
    }
}
