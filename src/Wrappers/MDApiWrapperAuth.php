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

namespace MapaDirectSDK\Wrappers;

use MapaDirectSDK\Wrappers\MDApiWrapperAbstract;

/**
 * @desc: API Client
 */
class MDApiWrapperAuth extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/users/authenticate';

    /**
     * @var string
     * @desc A-Token for auth
     */
    private $webHookHash;

    /**
     * @var string
     *
     */
    private $webHookUrl;

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (empty($this->credentials)) {
            $this->errors[] = 'L\'identifiant ou le mot de passe est invalide.';
        }
        if (empty($this->webHookHash) ||
                strlen($this->webHookHash) > 64) {
            $this->errors[] = 'Le webhookHash doit être envoyé à l\'API en header de la requète 
            et faire moins de 64 caractères.';
        }
        if (empty($this->webHookUrl) ||
                filter_var($this->webHookUrl, FILTER_VALIDATE_URL) == false) {
            $this->errors[] = 'Le webHookUrl doit être envoyé à l\'API en header de la requète et être une URL valide.';
        }

        return parent::check();
    }

    /**
     * @return string
     */
    public function getWebHookHash()
    {
        return $this->webHookHash;
    }

    /**
     * @param string $webHookHash
     */
    public function setWebHookHash($webHookHash)
    {
        $this->webHookHash = $webHookHash;
    }

    /**
     * @return string
     */
    public function getWebHookUrl()
    {
        return $this->webHookUrl;
    }

    /**
     * @param string $webHookUrl
     */
    public function setWebHookUrl($webHookUrl)
    {
        $this->webHookUrl = $webHookUrl;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers[] = 'X-SIRET: ' . $this->siret;
        $headers[] = 'X-WEBHOOKHASH: ' . $this->webHookHash;
        $headers[] = 'X-WEBHOOKURL: ' . $this->webHookUrl;

        return $headers;
    }
}
