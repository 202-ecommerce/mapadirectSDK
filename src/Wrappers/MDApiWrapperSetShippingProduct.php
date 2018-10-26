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
 *  /products/{productId}/shippings/{shippingId}
 */
class MDApiWrapperSetShippingProduct extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/products/';

    protected $method = 'PUT';

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (empty($this->id)) {
            $this->errors[] = 'L\'id_product est invalide.';
        }

        if (empty($this->input)) {
            $this->errors[] = 'Body request est invalide.';
        }

        if (!isset($this->input['status']) ||
            !in_array($this->input['status'],array("A", "D"))) {
            $this->errors[] = 'Le statut des frais d\'expédition est obligatoire et doit être l\'une des valeurs suivantes : A (activé) D (désactivé).';
        }

        if (!isset($this->input['rates'][0]['amount']) ||
            !is_numeric($this->input['rates'][0]['amount'])) {
            $this->errors[] = 'La valeur amount doit valoir 0 prix pour le premier article envoyé.';
        }
        if (!isset($this->input['rates'][0]['value']) ||
            !is_numeric($this->input['rates'][0]['value'])) {
            $this->errors[] = 'La valeur des frais de port pour le premier article envoyé doit être un chiffre décimal et s\'entend HT.';
        }

        if (!isset($this->input['rates'][1]['amount']) ||
            !is_numeric($this->input['rates'][1]['amount'])) {
            $this->errors[] = 'La valeur amount doit valoir 2 prix pour le premier article envoyé.';
        }
        if (!isset($this->input['rates'][1]['value']) ||
            !is_numeric($this->input['rates'][1]['value'])) {
            $this->errors[] = 'La valeur des frais de port à partir du deuxième article envoyé doit être un chiffre décimal et s\'entend HT.';
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
