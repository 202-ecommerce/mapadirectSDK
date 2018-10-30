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
use MapaDirectSDK\Wrappers\MDApiWrapperValidator;

/**
 * @desc: API Client
 */
class MDApiWrapperAddProduct extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/products';

    protected $method = 'POST';

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (!isset($this->input['product_code']) ||
            MDApiWrapperValidator::isEan13($this->input['product_code']) == false) {
            $this->errors[] = 'Le champs product_code doit être un EAN13 valide.';
        }

        if (!isset($this->input['product'])) {
            $this->errors[] = 'Le titre du produit est obligatoire.';
        }

        if (!isset($this->input['status']) ||
            !in_array($this->input['status'], array("H", "A", "D"))) {
            $this->errors[] = 'Le statut du produit est obligatoire et doit être l\'une des valeurs suivantes :
             A (available) H (hidden) D (disabled).';
        }

        if (!isset($this->input['inventory']['price']) ||
            !is_numeric($this->input['inventory']['price'])) {
            $this->errors[] = 'Le prix s\'entend HT, est obligatoire et doit être un nombre décimal.';
        }

        if (!isset($this->input['inventory']['amount']) ||
            !is_numeric($this->input['inventory']['amount'])) {
            $this->errors[] = 'La quantité en stock doit être un entier naturel en positif.';
        }

        if (!isset($this->input['inventory']['combination']) ||
            !is_array($this->input['inventory']['combination'])) {
            $this->errors[] = 'Le tableau de combinaison est obligatoire doit être un tableau ayant pour clef
            le champs company_id et pour valeur la main_category. Exemple : combination => [12 => 1144]';
        }

        if (!isset($this->input['inventory']['combination_code']) ||
            MDApiWrapperValidator::isEan13($this->input['inventory']['combination_code']) == false) {
            $this->errors[] = 'Le champs combination_code  doit être un EAN13 valide.';
        }

        if (!isset($this->input['green_tax']) ||
            !is_numeric($this->input['green_tax'])) {
            $this->errors[] =  'L\'éco participation devra être inclus dans le prix HT (champs price) et sera
            affiché sur la commande à titre indicatif. Ce champs est obligatoire et doit être un nombre décimal.';
        }

        if (!isset($this->input['tax_ids']) ||
            !is_array($this->input['tax_ids'])) {
            $this->errors[] = 'La TVA est obligatoire et doit être indiquée sous forme de tableau ayant pour valeur
             l\'identifiant de la Taxe. Exemple pour la TVA à 20% : tax_ids => [0 => 5] ';
        }

        if (!isset($this->input['main_category']) ||
            !is_int($this->input['main_category'])) {
            $this->errors[] = 'La categorie est obligatoire et doit être entier naturel positif correspondant 
            à une categorie MapaDirect.';
        }

        if (!isset($this->input['free_shipping']) ||
            !in_array($this->input['free_shipping'], array("Y", "N"))) {
            $this->errors[] = 'La gratuité des frais de port pour un produit est obligatoire et doit être
             l\'une des valeurs suivantes : Y (yes) ou N (No)';
        }

        if (!isset($this->input['infinite_stock']) || !is_bool($this->input['infinite_stock'])) {
            $this->errors[] = 'Le stock infini est obligatoire et doit être un boolean.';
        }

        return parent::check();
    }
}
