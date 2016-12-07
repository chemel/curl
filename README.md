# Curl
Curl Wrapper

## Install via composer

Edit your composer.json file to include the following:

```json
{
    "require": {
        "alc/curl": "dev-master"
    }
}
```

## Usage

```php

use Alc\Curl\Curl;

$curl = new Curl();

// GET request
$response = $curl->get('http://httpbin.org/get');
var_dump( $response->getStatusCode() );
print_r( $response->getJson() );

// POST request
$response = $curl->post('http://httpbin.org/post', array('var1' => 1, 'var2' => 2));
print_r( $response->getJson() );

```
