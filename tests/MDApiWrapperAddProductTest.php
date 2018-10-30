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

use MapaDirectSDK\Wrappers\MDApiWrapperAddProduct;
use PHPUnit\Framework\TestCase;

class MDApiWrapperAddProductTest extends TestCase
{

    public function testGetSet()
    {
        $wrapper = new MDApiWrapperAddProduct();
        $wrapper->setId(123);
        $this->assertEquals('/products', $wrapper->getURI());
        $this->assertEquals('POST', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

    }

    public function testCheck()
    {
        $wrapper = new MDApiWrapperAddProduct();
        $data = '52807584900042';
        $wrapper->setSiret($data);

        $product = array(
            'product_code' => '3700688558929',
            'product' => 'Very comfortable chair',
            'status' => 'A',
            'inventory' => array(
                'amount' => 1,
                'price' => 15.0,
                'combination' => array(),
                'combination_code' => '3700688558929',
            ),
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

        $product['inventory']['combination_code'] = "ean13";
        $wrapper->setInput($product);
        $this->assertFalse($wrapper->check());

        $wrapper->setInput(array());
        $this->assertFalse($wrapper->check());
    }

}
