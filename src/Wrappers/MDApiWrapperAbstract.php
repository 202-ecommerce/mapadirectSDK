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

use MapaDirectSDK\Wrappers\MDApiWrapperInterface;
use MapaDirectSDK\MDApiResponse;

/**
 * @desc: abstract wrapper of a webservice
 */
abstract class MDApiWrapperAbstract implements MDApiWrapperInterface
{
    protected $credentials;

    protected $uri;

    protected $method = 'GET';

    protected $id;

    protected $input;

    protected $token;

    protected $siret;

    /**
     * @param string $credentials
     * @return $this
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @return string
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set request body
     *
     * @param string $json
     *
     * @return $this
     */
    public function setInput($json)
    {
        $this->input = $json;

        return $this;
    }

    /**
     * @desc: get request body
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @desc: check if wrapper is correctly configurated
     *
     * @return bool
     */
    public function check()
    {
        if (empty($this->siret)) {
            return false;
        }

        return true;
    }

    /**
     * @desc: check if wrapper is correctly configured
     * @param MDApiResponse $response
     * @param string $data json response
     *
     * @return $this
     */
    public function parseResponse(MDApiResponse $response, $data)
    {
        $data = json_decode($data, true);
        $response->setContent($data);

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param string $siret
     * @return $this
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers[] = 'X-SIRET: ' . $this->siret;
        $headers[] = 'Authorization: token ' . $this->token;

        return $headers;
    }
}
