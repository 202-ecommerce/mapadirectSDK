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
