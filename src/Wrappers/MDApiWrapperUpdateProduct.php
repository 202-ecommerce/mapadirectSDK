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
 * @desc API Client
 */
class MDApiWrapperUpdateProduct extends MDApiWrapperAddProduct implements MDApiWrapperInterface
{
    protected $uri = '/products/';

    protected $method = 'PUT';

    /**
     * @inheritdoc
     */
    public function check()
    {

        if (!isset($this->input['product_id']) ||
            !is_int($this->input['product_id'])) {
            $this->errors[] = 'Le champs product_id doit être un entier naturel positif.';
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
