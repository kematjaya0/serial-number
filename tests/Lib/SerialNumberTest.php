<?php

namespace Kematjaya\SerialNumber\Tests\Lib;

use Kematjaya\SerialNumber\Lib\SerialNumber;
use Kematjaya\SerialNumber\Lib\SerialNumberInterface;
use PHPUnit\Framework\TestCase;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SerialNumberTest extends TestCase
{
    public function testSerialNumber()
    {
        $number = '12345';
        $salt   = 'kematjaya0@gmail.com';
        $sn = (new SerialNumber())->setNumber($number)->setSalt($salt);
        
        $this->assertEquals(PHP_OS, $sn->getOsVersion());
        $this->assertEquals(PHP_OS_FAMILY, $sn->getOsFamily());
        $this->assertEquals($number, $sn->getNumber());
        $this->assertEquals($salt, $sn->getSalt());
        $this->assertInstanceOf(SerialNumberInterface::class, $sn);
    }
}
