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
 *  /orders/{orderId}/setinvoicedata
 */
class MDApiWrapperSetTracking extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/shipments';

    protected $method = 'POST';

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (empty($this->id) && empty($this->input['order_id'])) {
            $this->errors[] = 'L\'id de la commande est obligatoire.';
        }
        if (!isset($this->input['products']) || count($this->input['products']) < 1) {
            $this->errors[] = 'Le tableau de produits est obligatoire.';
        } else {
            foreach ($this->input['products'] as $item_id => $quantity) {
                if (!is_int($item_id)) {
                    $this->errors[] = 'Le produit '.$item_id.' n\'est pas un identifiant valide.';
                }
                if (!is_int($quantity)) {
                    $this->errors[] = 'La quantité ('.$quantity.') pour le produit '.$item_id.' n\'est pas un entier naturel.';
                }
            }
        }

        return parent::check();
    }

    /**
     * @desc: get request body
     *
     * @return string
     */
    public function getInput()
    {
        if (empty($this->input['order_id'])) {
            $this->input['order_id'] = $this->id;
        }
        if (empty($this->input['tracking_number'])) {
            $this->input['tracking_number'] = 'colis_non_suivi';
        }

        return $this->input;
    }
}
