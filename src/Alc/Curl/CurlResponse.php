<?php

namespace Alc\Curl;

/**
 * CurlResponse
 */
class CurlResponse {

    protected $curl;

    public $url;
    public $content;

    public $error;
    public $errno;
    public $info;

    /**
     * Constructor
     *
     * @param Curl curl
     */
    public function __construct( Curl $curl ) {

        $this->curl = $curl;
    }

    /**
     * Get Curl instance
     *
     * @return Curl curl
     */
    public function getCurl() {

        return $this->curl;
    }

    /**
     * Get Content
     *
     * @return string content
     */
    public function getContent() {

        return $this->content;
    }

    /**
     * Get Json
     *
     * @return string json
     */
    public function getJson() {

        return json_decode( $this->getContent() );
    }

    /**
     * Get all informations
     *
     * @return array
     */
    public function getInfos() {

        return $this->info;
    }

    /**
     * Get information
     *
     * @param string key
     *
     * @return string info
     */
    public function getInfo( $key ) {

        return isset($this->info[$key]) ? $this->info[$key] : null;
    }

    /**
     * Get status code
     *
     * @return int httpCode
     */
    public function getStatusCode() {

        return $this->getInfo('http_code');
    }

    /**
     * Request is success
     *
     * @return boolean
     */
    public function success() {

        return $this->getStatusCode() == 200;
    }

    /**
     * Get redirect count
     *
     * @return int count
     */
    public function getRedirectCount() {

        return $this->getInfo('redirect_count');
    }

    /**
     * Get requested url
     *
     * @return string url
     */
    public function getRequestedUrl() {

        return $this->url;
    }

    /**
     * Get url (after redirections)
     *
     * @return string url
     */
    public function getUrl() {

        return $this->getInfo('url');
    }

    /**
     * toString
     */
    public function __toString() {

        return $this->getContent();
    }
}