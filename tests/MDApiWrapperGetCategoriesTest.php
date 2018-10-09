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

use MapaDirectSDK\Wrappers\MDApiWrapperGetCategories;
use PHPUnit\Framework\TestCase;

class MDApiWrapperGetCategoriesTest extends TestCase
{

    public function testGetSet()
    {
        $wrapper = new MDApiWrapperGetCategories();
        $wrapper->setId(123);
        $this->assertEquals('/catalog/categories/tree', $wrapper->getURI());
        $this->assertEquals('GET', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

    }
}
