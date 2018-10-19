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

use PHPUnit\Framework\TestCase;
use MapaDirectSDK\MDApiClient;
use MapaDirectSDK\MDApiResponse;

class MDApiClientTest extends TestCase
{
    /**
     * @var MDApiClient
     */
    private $clientMD;

    /**
     * @var MDApiResponse
     */
    private $responseMD;

    public function setUp()
    {
        $this->clientMD = new MDApiClient();
        $this->responseMD = new MDApiResponse('test');
    }

    public function testGetApiUrl()
    {
        $this->assertEquals(MDApiClient::DEFAULT_URL, $this->clientMD->getUrl());

        $wrapper = MDApiClient::getWrapper('GetTaxes');
        $this->expectException(Exception::class);
        $this->clientMD->call($wrapper);
    }

    public function testSetApiUrl()
    {
        $url = 'https://test/api';
        $this->clientMD->setApiUrl($url);
        $this->assertEquals($url, $this->clientMD->getUrl());
    }

    public function testRealWrapperNameGetWrapper()
    {
        foreach (MDApiClient::WRAPPER as $name => $class) {
            $this->assertInstanceOf($class, $this->clientMD->getWrapper($name));
        }
    }

    public function testWrongWrapperNameGetWrapper()
    {
        $wrapper = 'test';
        $this->expectException(Exception::class);
        $this->clientMD->getWrapper($wrapper);
    }

    public function testGetResponse()
    {
        $this->clientMD->setResponse($this->responseMD);
        $this->assertEquals($this->responseMD, $this->clientMD->getResponse());
    }

    public function testSetResponse()
    {
        $responseMD = new MDApiResponse('testSetResponse');
        $this->clientMD->setResponse($responseMD);
        $this->assertEquals($responseMD, $this->clientMD->getResponse());
    }


    public function testPing()
    {

        $wrapper = MDApiClient::getWrapper('Auth');
        $wrapper->setCredentials('tech+mapa_jacky@202-ecommerce.com:mattdelg');
        $wrapper->setSiret('20220220220220');
        $wrapper->setWebHookUrl('https://www.202-ecommerce.com/');
        $wrapper->setWebHookHash('488e7cafd8fc88f386ba2a88574a7f35');

        $client = new MDApiClient();
        $client->call($wrapper);
        $success = $client->getResponse()->isSuccess();
        $this->assertTrue($success);

        $data = $client->getResponse()->getContent();
        $wrapper = MDApiClient::getWrapper('Ping');
        $wrapper->setToken($data['apiKey']);
        $wrapper->setSiret('20220220220220');

        $client = new MDApiClient();
        $client->call($wrapper);
        $success = $client->getResponse()->isSuccess();
        $data = $client->getResponse()->getContent();
        print_r($data);
        $this->assertTrue($success);

    }

}
