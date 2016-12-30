<?php

namespace Alc\Curl;

/**
 * CurlInterface
 */
interface CurlInterface
{
    public function get($url, $getData = array());

    public function post($url, $postData = array());
}
