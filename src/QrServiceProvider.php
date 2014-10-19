<?php

namespace G;

use Silex\Application;
use Pimple\ServiceProviderInterface;
use Endroid\QrCode\QrCode;
use Pimple\Container;

class QrServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['qrCode'] = $app->protect(function ($text, $size = null) use ($app) {
            $default = $app['qr.defaults'];

            $qr = new QrWrapper(new QrCode());
            $qr->setText($text);
            $qr->setPadding($default['padding']);
            $qr->setSize(is_null($size) ? $default['size'] : $size);
            $qr->setImageType($default['imageType']);

            return $qr;
        });
    }

    public function boot(Application $app)
    {
    }
}