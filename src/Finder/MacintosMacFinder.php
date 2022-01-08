<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\SerialNumber\Finder;

/**
 * Description of MacintosMacFinder
 *
 * @author guest
 */
class MacintosMacFinder extends LinuxMacFinder 
{
    //put your code here
    protected function findMacAddress(string $string):?string 
    {
        if (false === strpos($string, '[ethernet]')) {
            
            return null;
        }
        
        if (false === strpos($string, 'permanent')) {
            
            return null;
        }
        
        if (false === strpos($string, '192.168')) {
            
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
