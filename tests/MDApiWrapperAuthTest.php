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

use MapaDirectSDK\Wrappers\MDApiWrapperAuth;
use PHPUnit\Framework\TestCase;

class MDApiWrapperAuthTest extends TestCase
{

    public function testSetGet()
    {
        $wrapper = new MDApiWrapperAuth();
        $wrapper->setId(123);
        $this->assertEquals('/users/authenticate', $wrapper->getURI());
        $this->assertEquals('GET', $wrapper->getMethod());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertEquals($wrapper->getSiret(), $data);

        $data = 'test';
        $wrapper->setInput($data);
        $this->assertEquals($wrapper->getInput(), $data);

        $data = 'my-secret-keys';
        $wrapper->setWebHookHash($data);
        $this->assertEquals($wrapper->getWebHookHash(), $data);

        $data = 'login:password';
        $wrapper->setCredentials($data);
        $this->assertEquals($wrapper->getCredentials(), $data);

        $data = 'login:password';
        $wrapper->setWebHookUrl($data);
        $this->assertEquals($wrapper->getWebHookUrl(), $data);

        $this->assertEquals($wrapper->getHeaders(), array("X-SIRET: 52807584900042", "X-WEBHOOKHASH: my-secret-keys", "X-WEBHOOKURL: login:password"));
    }


    public function testCheck()
    {
        $wrapper = new MDApiWrapperAuth();
        $this->assertFalse($wrapper->check());

        $data = '52807584900042';
        $wrapper->setSiret($data);
        $this->assertFalse($wrapper->check());

    }
}
