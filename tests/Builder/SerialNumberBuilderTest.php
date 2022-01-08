<?php

namespace Kematjaya\SerialNumber\Tests\Builder;

use Kematjaya\SerialNumber\Builder\SerialNumberBuilder;
use Kematjaya\SerialNumber\Lib\SerialNumber;
use Kematjaya\SerialNumber\Lib\SerialNumberInterface;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;
use PHPUnit\Framework\TestCase;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SerialNumberBuilderTest extends TestCase 
{
    public function testCreateBuilder()
    {
        $encoder = new NativePasswordHasher();
        $builder = new SerialNumberBuilder($encoder, new SerialNumber());
        $sn = $builder->generateSerialNumber();
        $this->assertInstanceOf(SerialNumberInterface::class, $sn);
        $this->assertEquals($sn->getNumber(), $builder->validateSerialNumber($sn->getNumber()));
    }
}
