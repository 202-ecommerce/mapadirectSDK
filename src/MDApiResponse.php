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

namespace MapaDirectSDK;

/**
 * @desc: API Response
 */
class MDApiResponse
{
    private $status;

    private $errors = array();

    private $content;

    public function __construct($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @desc: get status
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @desc: is success
     *
     * @return: boolean
     */
    public function isSuccess()
    {
        if ($this->status == 'success') {
            return true;
        }

        return false;
    }

    /**
     * @desc: get status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @desc: add error
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @desc: get errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @desc: set content
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @desc: get content
     */
    public function getContent()
    {
        return $this->content;
    }
}
