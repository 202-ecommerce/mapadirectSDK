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

class WebhookRequest
{
    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', str_replace('_', ' ', substr($name, 5)))] = $value;
            }
        }
        return $headers;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return file_get_contents('php://input');
    }
}
