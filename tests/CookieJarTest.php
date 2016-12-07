<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\Curl;
use Alc\Curl\CookieJar;

$curl = new Curl();

$cookieFile = '/tmp/php-curl-test.cookie';

$jar = new CookieJar($cookieFile);

$curl->setCookieJar($jar);


$response = $curl->get('http://httpbin.org/cookies/set?foo=1&bar=2');
print_r( $response->getJson() );


$jar->refresh();
// print_r($jar->getEntries());

$entry = $jar->find('httpbin.org', 'foo');
// print_r($entry);
$entry->setValue('3');

$jar->save();

$response = $curl->get('http://httpbin.org/headers');
print_r( $response->getJson() );
