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

use MapaDirectSDK\Wrappers\MDApiWrapperUpdateProduct;
use PHPUnit\Framework\TestCase;

class MDApiWrapperUpdateProductTest extends TestCase
{

    public function testGetSet()
    {
        $wrapper = new MDApiWrapperUpdateProduct();
        $wrapper->setId(123);
        $this->assertEquals('/products/123', $wrapper->getURI());
        $this->assertEquals('PUT', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

        $data = 'my-token-supply-by-mapadirect-api';
        $wrapper->setToken($data);
        $this->assertEquals($wrapper->getToken(), $data);

        $this->assertEquals($wrapper->getHeaders(), array("X-SIRET: 52807584900042", "Authorization: token my-token-supply-by-mapadirect-api"));
    }

    public function testCheck()
    {
        $wrapper = new MDApiWrapperUpdateProduct();
        $data = '52807584900042';
        $wrapper->setSiret($data);
        $wrapper->setId(123);
        $inventory = new \stdClass;
        $inventory->amount = (int) 1;
        $inventory->price = (float) 15.0;
        $inventory->combination = array();
        $product = array(
            'product_id' => 233345,
            'product_code' => '3700688558929',
            'product' => 'Very comfortable chair',
            'status' => 'A',
            'inventory' => array($inventory),
            'green_tax' => 1.0,
            'tax_ids' => [1],
            'main_category' => 1932,
            'free_shipping' => 'Y',
            'infinite_stock' => true
        );
        $wrapper->setInput($product);
        $this->assertTrue($wrapper->check());

        $product['product_code'] = "ean13";
        $wrapper->setInput($product);
        $this->assertFalse($wrapper->check());

        unset($product['product_id']);
        $wrapper->setInput($product);
        $this->assertFalse($wrapper->check());
    }

}
