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
use MapaDirectSDK\Wrappers\MDApiWrapperValidator;

/**
 * @desc: API Client
 *  /orders/{orderId}
 */
class MDApiWrapperApproveOrder extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/orders/';

    protected $method = 'PUT';

    protected $input = array('approved' => true, 'do_not_create_invoice' => true);

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (empty($this->id)) {
            $this->errors[] = 'L\'id de la commande est obligatoire.';
        }

        return parent::check();
    }

    /**
     * @inheritdoc
     */
    public function getUri()
    {
        return $this->uri.$this->id;
    }
}
