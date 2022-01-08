<?php

namespace Kematjaya\SerialNumber\Lib;

use Kematjaya\SerialNumber\Lib\SerialNumberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SerialNumber implements SerialNumberInterface
{
    
    /**
     * 
     * @var string
     */
    private $number;
    
    /**
     * 
     * @var string
     */
    private $salt;
    
    private $osVersion = PHP_OS;
    
    private $osFamily = PHP_OS_FAMILY;
    
    function getNumber() :?string
    {
        return $this->number;
    }

    function getSalt():?string
    {
        return $this->salt;
    }

    function getOsVersion():?string
    {
        return $this->osVersion;
    }

    function getOsFamily():?string
    {
        return $this->osFamily;
    }

    function setNumber(?string $number):SerialNumberInterface
    {
        $this->number = $number;
        
        return $this;
    }

    function setSalt(?string $salt):SerialNumberInterface
    {
        $this->salt = $salt;
        
        return $this;
    }

    function setOsVersion(?string $osVersion):SerialNumberInterface
    {
        $this->osVersion = $osVersion;
        
        return $this;
    }

    function setOsFamily(?string $osFamily):SerialNumberInterface
    {
        $this->osFamily = $osFamily;
        
        return $this;
    }

    
}
