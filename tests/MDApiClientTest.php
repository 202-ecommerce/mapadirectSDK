<?php

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
}
