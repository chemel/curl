<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\Curl\CookieJar;

$cookieFile = '/tmp/php-curl-test.cookie';

$jar = new CookieJar($cookieFile);

print_r($jar->getEntries());

// $jar->save();
