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

use MapaDirectSDK\Wrappers\MDApiWrapperSetTracking;
use PHPUnit\Framework\TestCase;

class MDApiWrapperSetTrackingTest extends TestCase
{

    public function testSetGet()
    {
        $wrapper = new MDApiWrapperSetTracking();
        $wrapper->setId(123);
        $this->assertEquals('/shipments', $wrapper->getURI());
        $this->assertEquals('POST', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

        $data = array(
            'comment' => "Colissimo 132465",
            'tracking_number' => "132465",
        );

        $wrapper->setInput($data);
        $data = array(
            'comment' => "Colissimo 132465",
            'tracking_number' => "132465",
            'order_id' => "123",
        );
        $this->assertEquals($wrapper->getInput(), $data);
    }


    public function testCheck()
    {
        $wrapper = new MDApiWrapperSetTracking();
        $data = '52807584900042';
        $wrapper->setSiret($data);
        $wrapper->setId(123);
        $data = array(
            'comment' => "Colissimo 132465",
            'tracking_number' => "132465",
        );
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());
        $data['products'] = array(
            'un' => "quatre",
        );
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());
        $this->assertEquals(3, count($wrapper->getErrors()));

        $data['invoiceDate'] = "2018-06-07T17:56:00";
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());
    }
}
