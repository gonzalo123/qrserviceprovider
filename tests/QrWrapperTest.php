<?php

use Symfony\Component\HttpFoundation\Response;
use Gonzalo123\QrWrapper;

class QrWrapperTest extends PHPUnit_Framework_TestCase
{
    public function testObjectInit()
    {
        $qrCode = $this->getMockBuilder('Endroid\QrCode\QrCode')
                ->disableOriginalConstructor()
                ->getMock();

        $wrapper = new QrWrapper($qrCode);

        $this->assertInstanceOf('Gonzalo123\QrWrapper', $wrapper);
    }

    public function testGetResponseWithDefaultParamenters()
    {
        $qrCode = $this->getMockBuilder('Endroid\QrCode\QrCode')
                ->disableOriginalConstructor()
                ->getMock();

        $qrCode->expects($this->any())->method('get')->will($this->returnValue("hello"));
        $wrapper = new QrWrapper($qrCode);

        $response = $wrapper->getResponse();

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
        $this->assertEquals("hello", $response->getContent());
        $this->assertEquals("image/png", $response->headers->get('Content-Type'));
    }

    public function testGetResponseForJpg()
    {
        $qrCode = $this->getMockBuilder('Endroid\QrCode\QrCode')
                ->disableOriginalConstructor()
                ->getMock();

        $qrCode->expects($this->any())->method('get')->will($this->returnValue("hello"));
        $wrapper = new QrWrapper($qrCode);
        $wrapper->setImageType('jpg');

        $response = $wrapper->getResponse();

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
        $this->assertEquals("hello", $response->getContent());
        $this->assertEquals("image/jpeg", $response->headers->get('Content-Type'));
    }

    public function testGetResponseForJpeg()
    {
        $qrCode = $this->getMockBuilder('Endroid\QrCode\QrCode')
                ->disableOriginalConstructor()
                ->getMock();

        $qrCode->expects($this->any())->method('get')->will($this->returnValue("hello"));
        $wrapper = new QrWrapper($qrCode);
        $wrapper->setImageType('jpg');

        $response = $wrapper->getResponse();

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
        $this->assertEquals("hello", $response->getContent());
        $this->assertEquals("image/jpeg", $response->headers->get('Content-Type'));
    }

    public function testReusingResponse()
    {
        $qrCode = $this->getMockBuilder('Endroid\QrCode\QrCode')
                ->disableOriginalConstructor()
                ->getMock();

        $qrCode->expects($this->any())->method('get')->will($this->returnValue("hello"));
        $wrapper = new QrWrapper($qrCode);

        $response = new Response('foo');
        $response->headers->set('xxx', 'gonzalo');

        $response = $wrapper->getResponse($response);

        $this->assertEquals("hello", $response->getContent());
        $this->assertEquals("image/png", $response->headers->get('Content-Type'));
        $this->assertEquals("gonzalo", $response->headers->get('xxx'));
    }
}