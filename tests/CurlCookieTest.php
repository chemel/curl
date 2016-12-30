<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\Curl;

$cookieFile = '/tmp/php-curl-test.cookie';

$curl = new Curl();
$curl->setCookieJar($cookieFile);

$response = $curl->get('http://httpbin.org/cookies/set?var1=1&var2=2');
print_r($response->getJson());

$response = $curl->get('http://httpbin.org/headers');
print_r($response->getJson());
