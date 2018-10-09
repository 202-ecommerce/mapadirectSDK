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

/**
 * @desc: interface wrapper of a webservice
 */
interface MDApiWrapperInterface
{
    /**
     * @desc: set credential
     * @param: string $url
     *
     * @return $this
     */
    public function setCredentials($credentials);

    /**
     * @desc: get credential
     *
     * @return string
     */
    public function getCredentials();

    /**
     * @desc: get API url (prod or qa)
     *
     * @return string
     */
    public function getUri();

    /**
     * @desc: get request method
     *
     * @return string
     */
    public function getMethod();

    /**
     * @desc: set request body
     * @param: string $json
     *
     * @return $this
     */
    public function setInput($json);

    /**
     * @desc: get request body
     *
     * @return string
     */
    public function getInput();

    /**
     * @desc: check if wrapper is correctly configured
     *
     * @return bool
     */
    public function check();

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @return string
     */
    public function getSiret();

    /**
     * @param string $siret
     * @return $this
     */
    public function setSiret($siret);

    /**
     * @return array
     */
    public function getHeaders();
}
