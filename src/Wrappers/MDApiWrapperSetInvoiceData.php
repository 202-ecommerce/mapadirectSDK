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

use foo\bar;
use MapaDirectSDK\Wrappers\MDApiWrapperAbstract;
use MapaDirectSDK\Wrappers\MDApiWrapperValidator;

/**
 * @desc: API Client
 *  /orders/{orderId}/setinvoicedata
 */
class MDApiWrapperSetInvoiceData extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/orders/';

    protected $method = 'PUT';

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (empty($this->id)) {
            $this->errors[] = 'L\'id_order est obligatoire.';
        }

        if (!isset($this->input['invoiceNumber']) ||
            empty($this->input['invoiceNumber'])) {
            $this->errors[] = ' Le numéro de facture est obligatoire et disposer d\'au moins un chiffre.';
        }

        if (!isset($this->input['invoiceDate']) ||
            !MDApiWrapperValidator::validateDate($this->input['invoiceDate'])) {
            $this->errors[] = ' Le date de la facture est obligatoire être au format ISO 8601.';
        }

        return parent::check();
    }

    /**
     * @inheritdoc
     */
    public function getUri()
    {
        return $this->uri.$this->id.'/setinvoicedata';
    }
}
