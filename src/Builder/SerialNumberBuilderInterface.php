<?php

namespace Kematjaya\SerialNumber\Builder;

use Kematjaya\SerialNumber\Lib\SerialNumberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface SerialNumberBuilderInterface 
{
    public function getSalt();
    
    public function generateSerialNumber(): SerialNumberInterface;
    
    public function validateSerialNumber($number):?string;
    
    public function getSerialNumber(): ?SerialNumberInterface;
}
