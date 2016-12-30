<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\Curl;

$curl = new Curl();

var_dump($curl->unshortUrl('http://t.co/T3oDMPyUOE'));

var_dump($curl->unshortUrl('http://lemde.fr/1tQWoBY'));
