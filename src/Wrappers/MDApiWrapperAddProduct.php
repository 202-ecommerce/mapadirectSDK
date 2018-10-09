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
class MDApiWrapperAddProduct extends MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $uri = '/products';

    protected $method = 'POST';

    /**
     * @inheritdoc
     */
    public function check()
    {
        if (empty($this->input)) {
            return false;
        }
        return parent::check();
    }
}
