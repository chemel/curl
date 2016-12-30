<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\Curl;

$curl = new Curl();
$curl->useChrome();

// GET request
$response = $curl->get('http://httpbin.org/get');
var_dump($response->getStatusCode());
var_dump($response->success());
print_r($response->getJson());

// POST request
$response = $curl->post('http://httpbin.org/post', array('var1' => 1, 'var2' => 2));
print_r($response->getJson());
