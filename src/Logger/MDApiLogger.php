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

namespace MapaDirectSDK\Logger;

/**
 * @desc: API Response
 */
class MDApiLogger
{

    /**
     * @desc: write log. Default class is just an interface
     *
     * @param string $status
     * @return $this
     */
    public function write($level = 'info', $message = '', $wrapper = '')
    {
    }
}
