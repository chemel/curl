<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\Curl;

$curl = new Curl();

$curl->download('http://stackoverflow.com', '/tmp/');
