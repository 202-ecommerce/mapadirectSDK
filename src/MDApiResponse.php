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

namespace MapaDirectSDK;

/**
 * @desc: API Response
 */
class MDApiResponse
{
    private $status;

    private $errors = array();

    private $content;

    /**
     * MDApiResponse constructor.
     * @param string $status
     */
    public function __construct($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @desc: get status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @desc: is success
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->status === 'success';
    }

    /**
     * @desc: get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @desc: add error
     * @param string $error
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @desc: get errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @desc: set content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @desc: get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
