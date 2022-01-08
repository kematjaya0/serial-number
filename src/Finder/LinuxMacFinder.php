<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\SerialNumber\Finder;

/**
 * Description of LinuxMacFinder
 *
 * @author guest
 */
class LinuxMacFinder implements MacFinderInterface
{
    //put your code here
    public function getMacAddress(): string 
    {
        ob_start();  
        system('arp -a $_IP_ADDRESS');  
        $myComSys = ob_get_contents();  
        ob_clean();
        
        if (0 == strlen($myComSys)) {
            
            throw new \Exception(sprintf("cannot find '%s' config", 'en0'));
        }
        
        foreach (explode("\n", $myComSys) as $string) {
            $address = $this->findMacAddress($string);
            if (null === $address) {
                continue;
            }
            
            return $address;
        }
        
        throw new \Exception("cannot find address.");
    }
    
    protected function findMacAddress(string $string):?string
    {
        if (false === strpos($string, '[ether]')) {
            
            return null;
        }
        
        $keys = 'at';
        $position = strpos($string, $keys);
        if (false === $position) {
            
            return null;
        }
        
        $macAddress = substr($string, ($position + strlen($keys) + 1), 17);
        if (0 == strlen($macAddress)) {
            
            return null;
        }
        
        return trim($macAddress);
    }

}
