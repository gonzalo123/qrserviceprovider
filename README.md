Qr code service provider for silex
======================

[![Build Status](https://travis-ci.org/gonzalo123/qrserviceprovider.png?branch=master)](https://travis-ci.org/gonzalo123/qrserviceprovider)

## Requirements

* Dependencies:
 * [`QrCode`](https://github.com/endroid/QrCode)

## Installation

### Add in your composer.json

``` js
{
    "require": {
        "gonzalo123/qrserviceprovider": "dev-master"
    }
}
```
## Example

```php
use Silex\Application;
use G\QrServiceProvider;

$app = new Application();

$app->register(new QrServiceProvider(), [
    'qr.defaults' => [
        'padding'   => 5, // default: 0
        'size'      => 200,
        'imageType' => 'png', // png, gif, jpeg, wbmp (default: png)
    ]
]);

$app->get("/qr/base64/{text}", function($text) use ($app) {
    return $app['qrCode'](base64_decode($text))->getResponse();
});

$app->get("/qr/{text}", function($text) use ($app) {
    return $app['qrCode']($text)->getResponse();
});

$app->run();
```
