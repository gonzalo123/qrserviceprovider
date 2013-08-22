<?php

namespace Gonzalo123;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Endroid\QrCode\QrCode;

class QrServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
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