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

use MapaDirectSDK\Wrappers\MDApiWrapperPing;
use PHPUnit\Framework\TestCase;

class MDApiWrapperPingTest extends TestCase
{

    public function testGetSet()
    {
        $wrapper = new MDApiWrapperPing();
        $this->assertEquals('/webhook/ping', $wrapper->getURI());
        $this->assertEquals('GET', $wrapper->getMethod());
    }

}
