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
    private $secureKey;

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
            return false;
        }

        return parent::check();
    }

    /**
     * @return string
     */
    public function getSecureKey()
    {
        return $this->secureKey;
    }

    /**
     * @param string $secureKey
     */
    public function setSecureKey($secureKey)
    {
        $this->secureKey = $secureKey;
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
        $headers[] = 'X-WEBHOOKHASH: ' . $this->secureKey;
        $headers[] = 'X-WEBHOOKURL: ' . $this->webHookUrl;

        return $headers;
    }
}
