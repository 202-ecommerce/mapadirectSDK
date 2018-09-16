<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to a commercial license from SARL 202 ecommence
 * Use, copy, modification or distribution of this source file without written
 * license agreement from the SARL 202 ecommence is strictly forbidden.
 * In order to obtain a license, please contact us: tech@202-ecommerce.com
 * ...........................................................................
 * INFORMATION SUR LA LICENCE D'UTILISATION
 *
 * L'utilisation de ce fichier source est soumise a une licence commerciale
 * concedee par la societe 202 ecommence
 * Toute utilisation, reproduction, modification ou distribution du present
 * fichier source sans contrat de licence ecrit de la part de la SARL 202 ecommence est
 * expressement interdite.
 * Pour obtenir une licence, veuillez contacter 202-ecommerce <tech@202-ecommerce.com>
 * ...........................................................................
 *
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright Copyright (c) 202-ecommerce
 * @license   Commercial license
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
