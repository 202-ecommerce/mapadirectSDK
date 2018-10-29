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

        $siret = '52807584900042';
        $wrapper->setSiret($siret);
        $data = array(
            'comment' => "Colissimo 132465",
            'tracking_number' => "132465",
            'order_id' => 123,
        );
        $wrapper->setInput($data);
        $this->assertEquals($wrapper->getInput(), $data);

        $wrapper = new MDApiWrapperSetTracking();
        $siret = '52807584900042';
        $wrapper->setSiret($siret);
        $wrapper->setId(123);
        $data = array(
            'comment' => "Colissimo 132465",
        );
        $wrapper->setInput($data);
        $expectedData = array(
            'order_id' => 123,
            'tracking_number' => 'colis_non_suivi',
            'comment' => "Colissimo 132465",
        );
        $this->assertEquals($wrapper->getInput(), $expectedData);
    }


    public function testCheck()
    {
        $wrapper = new MDApiWrapperSetTracking();
        $siret = '52807584900042';
        $wrapper->setSiret($siret);
        $this->assertFalse($wrapper->check());

        $wrapper->setId(123);
        $data = array(
            'comment' => "Colissimo 132465",
            'tracking_number' => "132465",
        );
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());

        $wrapper = new MDApiWrapperSetTracking();
        $siret = '52807584900042';
        $wrapper->setSiret($siret);
        $data['products'] = array(
            'un' => "quatre",
        );
        $wrapper->setInput($data);
        $this->assertFalse($wrapper->check());
        $this->assertEquals(3, count($wrapper->getErrors()));

        $wrapper = new MDApiWrapperSetTracking();
        $siret = '52807584900042';
        $wrapper->setId(123);
        $wrapper->setSiret($siret);
        $data = array(
            'comment' => "Colissimo 132465",
            'products' => array(
                1234 => 10,
                1235 => 3,
            )
        );
        $wrapper->setInput($data);$wrapper->check();
        $this->assertTrue($wrapper->check());
    }
}
