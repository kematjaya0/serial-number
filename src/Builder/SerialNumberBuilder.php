<?php

namespace Kematjaya\SerialNumber\Builder;

use Kematjaya\SerialNumber\Lib\SerialNumberInterface;
use Kematjaya\SerialNumber\Builder\SerialNumberBuilderInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SerialNumberBuilder implements SerialNumberBuilderInterface
{
    const OS_WIN_7 = 'WINNT';
    const OS_LINUX = 'Linux';
    
    protected $encoder;
    
    protected $serialNumber;
    
    function __construct(PasswordEncoderInterface $encoder, SerialNumberInterface $serialNumber)
    {
        $this->serialNumber = $serialNumber;
        $this->encoder = $encoder;
    }
    
    private function getWindowsMac()
    {
        ob_start();  
        system('ipconfig /all');  
        $myComSys = ob_get_contents();  
        ob_clean();  
        
        $findMac = "Physical"; 
        
        $pMac = strpos($myComSys, $findMac);  
        
        $macAddress = substr($myComSys,($pMac+36),17);
        
        $mac = explode("  ", exec('getmac'));
        if(isset($mac[0]) and trim($mac[0]) == trim($macAddress)) {
            return trim($mac[0]);
        }
        
        return trim($macAddress);
    }
    
    private function getLinuxMac()
    {
        return 'on-progress';
    }
    
    private function getMacAddress()
    {
        $mac = null;
        switch(PHP_OS){
            case self::OS_WIN_7:
                $mac = $this->getWindowsMac();
                break;
            case self::OS_LINUX:
                $mac = $this->getLinuxMac();
                break;
            default:
                throw new \Exception(sprintf('not supported for: %s', PHP_OS));
                break;
        }
        
        return $mac;
    }
    
    public function getSalt()
    {
        return PHP_OS_FAMILY;
    }
    
    public function generateSerialNumber(): SerialNumberInterface
    {
        $salt = $this->getSalt();
        $number = $this->encoder->encodePassword( $this->getMacAddress(), $salt);
        $this->serialNumber->setNumber($number)
            ->setSalt($salt);
        return $this->serialNumber;
    }
    
    public function validateSerialNumber($number):?string
    {
        if($this->encoder->isPasswordValid($number, $this->getMacAddress(), $this->getSalt()))
        {
            return $number;
        }
        
        return null;
    }
    
    public function getSerialNumber(): ?string
    {
        return $this->generateSerialNumber()->getNumber();
    }
}
