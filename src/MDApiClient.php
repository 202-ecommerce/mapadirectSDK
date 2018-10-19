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

use MapaDirectSDK\MDApiResponse;
use MapaDirectSDK\Wrappers\MDApiWrapperAuth;
use MapaDirectSDK\Wrappers\MDApiWrapperAddProduct;
use MapaDirectSDK\Wrappers\MDApiWrapperSetInvoiceData;
use MapaDirectSDK\Wrappers\MDApiWrapperUpdateProduct;
use MapaDirectSDK\Wrappers\MDApiWrapperSetShippingProduct;
use MapaDirectSDK\Wrappers\MDApiWrapperDeleteProduct;
use MapaDirectSDK\Wrappers\MDApiWrapperGetCategories;
use MapaDirectSDK\Wrappers\MDApiWrapperGetTaxes;
use MapaDirectSDK\Wrappers\MDApiWrapperGetProduct;
use MapaDirectSDK\Wrappers\MDApiWrapperPing;
use MapaDirectSDK\Wrappers\MDApiWrapperInterface;
use MapaDirectSDK\Logger\MDApiLogger;

/**
 * @desc: API Client
 */
class MDApiClient
{
    const DEFAULT_URL = 'https://sandbox.mapadirect.fr/marketplace/connectors';

    const WRAPPER = array(
        'Auth'               => MDApiWrapperAuth::class,
        'AddProduct'         => MDApiWrapperAddProduct::class,
        'UpdateProduct'      => MDApiWrapperUpdateProduct::class,
        'SetShippingProduct' => MDApiWrapperSetShippingProduct::class,
        'DeleteProduct'      => MDApiWrapperDeleteProduct::class,
        'GetCategories'      => MDApiWrapperGetCategories::class,
        'GetTaxes'           => MDApiWrapperGetTaxes::class,
        'GetProduct'         => MDApiWrapperGetProduct::class,
        'Ping'               => MDApiWrapperPing::class,
        'SetInvoiceData'     => MDApiWrapperSetInvoiceData::class,
    );

    private $url;

    private $ch;

    /**
     * @var MDApiResponse $response
     */
    private $response;

    /**
     * @var MDApiWrapperInterface $wrapper
     */
    private $wrapper;

    /**
     * @var MDApiLogger $logger
     */
    private $logger;

    /**
     * MDApiClient constructor.
     */
    public function __construct()
    {
        $this->url = (defined('MDAPI_URL')) ? MDAPI_URL : static::DEFAULT_URL;
        $this->logger = new MDApiLogger();
    }


    /**
     * @desc: get an instance of a new wrapper
     * @param string $wrapper
     * @return MDApiWrapperInterface
     * @throws Exception
     */
    public static function getWrapper($wrapper)
    {
        $wrappers = static::WRAPPER;
        $wrappersName = array_keys($wrappers);

        if (!in_array($wrapper, $wrappersName, true)) {
            throw new \Exception('Please set a wrapper in: '. implode(', ', $wrappersName));
        }

        return new $wrappers[$wrapper];
    }

    /**
     * @desc: set logger
     * @param: MDApiLogger $logger
     *
     * @return $this
     */
    public function setLogger(MDApiLogger $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @desc: set API url (prod or qa)
     * @param: string $url
     *
     * @return $this
     */
    public function setApiUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @desc: call a webservice
     * @param MDApiWrapperInterface $wrapper
     * @return bool
     * @throws Exception
     */
    public function call(MDApiWrapperInterface $wrapper)
    {
        $this->wrapper = $wrapper;
        if ($this->wrapper->check()) {
            return $this->send();
        } else {
            throw new \Exception('Please verify the configuration of your wrapper.
            Did you forget to set credential or input data ?');
        }
    }

    /**
     * @desc: Send the cUrl request
     * @return bool
     */
    private function send()
    {
        if (!$this->wrapper) {
            throw new \Exception('Please set a webservice before calling ');
        }

        $url = $this->url . $this->wrapper->getUri();
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->wrapper->getMethod());
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);

        if (!empty($this->wrapper->getCredentials())) {
            curl_setopt($this->ch, CURLOPT_USERPWD, $this->wrapper->getCredentials());
            curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }

        if ($this->wrapper->getMethod() == 'POST' || $this->wrapper->getMethod() == 'PUT') {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->wrapper->getInput()));
        }

        $headers = $this->wrapper->getHeaders();

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $content = curl_exec($this->ch);
        $httpsCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        curl_close($this->ch);

        $message = 'Request:' . " \r\n";
        $message .= 'URI: ' . $this->wrapper->getUri() . " \r\n";
        $message .= 'Header: ' . print_r($this->wrapper->getHeaders(), true) . " \r\n";
        $message .= 'Body: ' . print_r($this->wrapper->getInput(), true) . " \r\n";
        $message .= 'Response: ***' . " \r\n";
        $message .= 'Status: ' . $httpsCode ." \r\n";
        $message .= 'Body: ' . $content;
        $wrappers = array_flip(static::WRAPPER);
        $this->logger->write('info', $message, $wrappers[get_class($this->wrapper)]);

        if ($httpsCode == 200) {
            $this->response = new MDApiResponse('success');
            $this->wrapper->parseResponse($this->response, $content);
            return true;
        } else {
            $this->response = new MDApiResponse('failure');
            $this->wrapper->parseResponse($this->response, $content);
            return false;
        }
    }

    /**
     * @param MDApiResponse $response
     * @return $this;
     */
    public function setResponse(MDApiResponse $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @desc: get response
     *
     * @return MDApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
