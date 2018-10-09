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

use MapaDirectSDK\Wrappers\MDApiWrapperDeleteProduct;
use PHPUnit\Framework\TestCase;

class MDApiWrapperDeleteProductTest extends TestCase
{

    public function testGetSet()
    {
        $wrapper = new MDApiWrapperDeleteProduct();
        $wrapper->setId(123);
        $this->assertEquals('/products/123', $wrapper->getURI());
        $this->assertEquals('DELETE', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

    }

    public function testCheck()
    {
        $wrapper = new MDApiWrapperDeleteProduct();
        $this->assertFalse($wrapper->check());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertFalse($wrapper->check());
        $wrapper->setId(123);
        $this->assertTrue($wrapper->check());
    }
}
