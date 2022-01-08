<?php

namespace Kematjaya\SerialNumber\Builder;

use Kematjaya\SerialNumber\Finder\LinuxMacFinder;
use Kematjaya\SerialNumber\Finder\MacintosMacFinder;
use Kematjaya\SerialNumber\Finder\WindowsMacFinder;
use Kematjaya\SerialNumber\Lib\SerialNumberInterface;
use Kematjaya\SerialNumber\Builder\SerialNumberBuilderInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SerialNumberBuilder implements SerialNumberBuilderInterface
{
    const OS_WIN_7 = 'WINNT';
    const OS_LINUX = 'Linux';
    
    /**
     * 
     * @var PasswordHasherInterface
     */
    protected $encoder;
    
    /**
     * 
     * @var SerialNumberInterface
     */
    protected $serialNumber;
    
    function __construct(PasswordHasherInterface $encoder, SerialNumberInterface $serialNumber)
    {
        $this->serialNumber = $serialNumber;
        $this->encoder = $encoder;
    }
    
    private function getMacAddress()
    {
        if (PHP_OS === self::OS_WIN_7) {
            
            return (new WindowsMacFinder())->getMacAddress();
        }
        
        if (PHP_OS === self::OS_LINUX) {
            return (new LinuxMacFinder())->getMacAddress();
        }
        
        return (new MacintosMacFinder())->getMacAddress();
    }
    
    public function getSalt()
    {
        return PHP_OS_FAMILY;
    }
    
    public function generateSerialNumber(): SerialNumberInterface
    {
        $salt = $this->getSalt();
        $number = $this->encoder->hash($this->getMacAddress());
        $this->serialNumber->setNumber($number)
            ->setSalt($salt);
        
        return $this->serialNumber;
    }
    
    public function validateSerialNumber($number):?string
    {
        if (!$this->encoder->verify($number, $this->getMacAddress())) {
            
            return null;
        }
        
        return $number;
    }
    
    public function getSerialNumber(): ?string
    {
        return $this->generateSerialNumber()->getNumber();
    }
}
