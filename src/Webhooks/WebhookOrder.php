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

namespace MapaDirectSDK\Webhooks;

use MapaDirectSDK\Webhooks\WebhookPingException;
use MapaDirectSDK\Webhooks\WebhookErrorException;

class WebhookOrder
{

    private $webHookHash;
    private $request;
    private $data;

    /**
     * @param string $webHookHash
     */
    public function setWebHookHash($webHookHash)
    {
        $this->webHookHash = $webHookHash;
    }

    /**
     * @param string $webHookHash
     */
    public function setRequest(WebhookRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return boolean
     */
    public function process()
    {
        $headers = $this->request->getHeaders();

        if (!isset($headers['X-WEBHOOKHASH']) || $headers['X-WEBHOOKHASH'] !== $this->webHookHash) {
            throw new WebhookErrorException('Error with hash');
        }

        $body = $this->request->getBody();
        if (empty($body)) {
            throw new WebhookPingException('Ping OK');
        }
        $this->data = json_decode($body, true);
        $error = json_last_error();
        if ($error) {
            throw new WebhookErrorException(json_last_error_msg());
        }
        if (empty($this->data)) {
            throw new WebhookPingException('Ping OK');
        }

        return true;
    }

    /**
     * @return boolean
     */
    public function getData()
    {
        return $this->data;
    }
}
