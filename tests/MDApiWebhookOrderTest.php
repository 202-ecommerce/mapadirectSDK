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
            $this->assertEquals('{"message":"Error with hash"}', $e->sendResponse());
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
            $this->assertEquals('{"message":"Ping OK"}', $e->sendResponse());
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
            $this->assertEquals('{"message":"State mismatch (invalid or malformed JSON)"}', $e->sendResponse());
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

