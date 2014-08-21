<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\Curl;

$curl = new Curl();

$headers = $curl->getHttpHeaders('http://www.lemonde.fr/');

print_r($headers);
