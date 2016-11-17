<?php

namespace Alc\Curl;

/**
 * CurlInterface
 */
interface CurlInterface {

	public function get( $url, $getData = array(), $options = null );

	public function post( $url, $postData = array(), $options = null );
}