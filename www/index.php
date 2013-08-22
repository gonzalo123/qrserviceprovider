<?php

include __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Gonzalo123\QrServiceProvider;

$app = new Application();
$app['debug'] = true;

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