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
use MapaDirectSDK\Webhooks\WebhookOrder;
use MapaDirectSDK\Webhooks\WebhookPingException;
use MapaDirectSDK\Webhooks\WebhookErrorException;
use MapaDirectSDK\Webhooks\WebhookRequest;

class MDApiWebhookOrderTest extends TestCase
{


    public function testWebHookHashError()
    {
        $wrapper = new WebhookOrder();

        $webHookHash = '123456789';
        $wrapper->setWebHookHash($webHookHash);
        $wrapper->setRequest(new WebhookRequestError);
        try {
            $wrapper->process();
        } catch (WebhookErrorException $e) {
            $this->assertEquals('{"success":false,"message":"Error with hash"}', $e->sendResponse());
        }
    }

    public function testWebHookHashPing()
    {
        $wrapper = new WebhookOrder();

        $webHookHash = '123456789';
        $wrapper->setWebHookHash($webHookHash);
        $wrapper->setRequest(new WebhookRequestPing);
        try {
            $wrapper->process();
        } catch (WebhookPingException $e) {
            $this->assertEquals('{"success":true,"message":"Ping OK"}', $e->sendResponse());
        }
    }

    public function testWebHookJsonError()
    {
        $wrapper = new WebhookOrder();

        $webHookHash = '123456789';
        $wrapper->setWebHookHash($webHookHash);
        $wrapper->setRequest(new WebhookRequestJsonError);
        try {
            $wrapper->process();
        } catch (WebhookErrorException $e) {
            $this->assertEquals('{"success":false,"message":"State mismatch (invalid or malformed JSON)"}', $e->sendResponse());
        }
    }

    public function testWebHookHashSucess()
    {
        $wrapper = new WebhookOrder();

        $webHookHash = '123456789';
        $wrapper->setWebHookHash($webHookHash);
        $wrapper->setRequest(new WebhookRequestSuccess);
        $wrapper->process();
        $data = $wrapper->getData();

        $this->assertEquals('125', $data['id']);
    }
}


class WebhookRequestError extends WebhookRequest
{
    /**
     * @return array
     */
    public function getHeaders()
    {
        return ['X-WEBHOOKHASH' => 'false-key'];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return '';
    }
}

class WebhookRequestPing extends WebhookRequest
{
    /**
     * @return array
     */
    public function getHeaders()
    {
        return ['X-WEBHOOKHASH' => '123456789'];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return '';
    }
}


class WebhookRequestJsonError extends WebhookRequest
{
    /**
     * @return array
     */
    public function getHeaders()
    {
        return ['X-WEBHOOKHASH' => '123456789'];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return '[}]';
    }
}

class WebhookRequestSuccess extends WebhookRequest
{
    /**
     * @return array
     */
    public function getHeaders()
    {
        return ['X-WEBHOOKHASH' => '123456789'];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return '
    {
        "id": "125",
        "siretNumber": "52807584900042",
        "total": 123.45,
        "subtotal": 123.45,
        "timestamp": 1.5,
        "status": "SENT",
        "shippingAddress": {
        "contactFullName": "Michel Martin",
        "company": "202 ecommerce",
        "address": "Rue Vivienne",
        "address2": "",
        "city": "Paris",
        "zipcode": "75002",
        "country": "FR",
        "contactPhone": "+33123456789"
    },
        "items": [
            {
            "productName": "Stylo 4 couleurs",
            "productCode": "4006381333933",
            "price": 100,
            "amount": 1
        }
        ],
        "paymentMethod": "string"
    }
';
    }
}

