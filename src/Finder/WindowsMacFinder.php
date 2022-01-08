<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\SerialNumber\Finder;

/**
 * Description of WindowsMacFinder
 *
 * @author guest
 */
class WindowsMacFinder implements MacFinderInterface
{
    //put your code here
    public function getMacAddress(): string 
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

}
