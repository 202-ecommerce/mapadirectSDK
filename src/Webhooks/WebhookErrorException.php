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

class WebhookErrorException extends \Exception
{
    /**
     * @return string
     */
    public function sendResponse()
    {
        if (!headers_sent()) {
            header("HTTP/1.0 400");
            header("Content-Type: application/json");
        }
        $body = ["success" => false, "message" => $this->getMessage()];
        return json_encode($body);
    }
}
