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
     * @desc: set credential
     * @param: string $url
     *
     * @return this
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @desc: get credential
     * @param: string $url
     *
     * @return this
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @desc: set API url (prod or qa)
     * @param: string $url
     *
     * @return this
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @desc: set request tsId
     * @param: string $tsId
     *
     * @return this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @desc: set request method
     * @param: string $method
     *
     * @return this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @desc: get request method
     *
     * @return this
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @desc: set request body
     * @param: string $json
     *
     * @return this
     */
    public function setInput($json)
    {
        $this->input = $json;

        return $this;
    }

    /**
     * @desc: get request body
     *
     * @return this
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @desc: check if wrapper is correctly configurated
     *
     * @return this
     */
    public function check()
    {
        return false;
    }

    /**
     * @desc: check if wrapper is correctly configured
     * @param: $response MDApiResponse Response object
     * @param: $data     string        json response
     *
     * @return this
     */
    public function parseReponse(MDApiResponse $response, $data)
    {
        $data = json_decode($data, true);
        $response->setContent($data);

        return $this;
    }

    public function setToken($token)
    {
        return $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getSiret()
    {
        return $this->siret;
    }

    public function setSiret($siret)
    {
        $this->siret = $siret;
    }
}
