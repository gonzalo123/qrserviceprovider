<?php

namespace Gonzalo123;

use Endroid\QrCode\QrCode;
use Symfony\Component\HttpFoundation\Response;

class QrWrapper
{
    private $qrCode;
    private $text;
    private $size;
    private $padding;
    private $imageType;

    const DEFAULT_TYPE = 'png';

    public function __construct(QrCode $qrCode)
    {
        $this->qrCode = $qrCode;
    }

    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
    }

    public function setPadding($padding)
    {
        $this->padding = $padding;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getResponse(Response $response = null)
    {
        $this->populateQrCode();

        if (is_null($response)) {
            $response = new Response();
        }

        $response->setContent($this->qrCode->get());
        $response->headers->set('Content-Type', $this->getMimeTypeFromType($this->imageType));

        return $response;
    }

    private function populateQrCode()
    {
        $this->qrCode->setImageType($this->imageType);
        $this->qrCode->setPadding($this->padding);
        $this->qrCode->setSize($this->size);
        $this->qrCode->setText($this->text);
    }

    private function getMimeTypeFromType($type)
    {
        $type = $type == '' ? self::DEFAULT_TYPE : $type;
        return 'image/' . str_replace('jpg', 'jpeg', $type);
    }
}