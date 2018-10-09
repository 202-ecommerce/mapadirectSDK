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
use MapaDirectSDK\MDApiResponse;

class MDApiResponseTest extends TestCase
{

    public function testContent()
    {
        $response = new MDApiResponse('success');
        $data = '{"test":"test"}';
        $response->setContent($data);
        $this->assertEquals($response->getContent(), $data);
    }

    public function testSetStatus()
    {
        $response = new MDApiResponse('success');
        $this->assertTrue($response->isSuccess());
        $response->setStatus('failed');
        $this->assertFalse($response->isSuccess());
    }

    public function testError()
    {
        $response = new MDApiResponse('success');
        $data = '{"test":"test"}';
        $response->addError($data);
        $this->assertEquals($response->getErrors(), array($data));

    }
}
