<?php

namespace Kematjaya\SerialNumber\Lib;

use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface SerialNumberInterface
{
    function getNumber() :?string;

    function getSalt():?string;

    function getOsVersion():?string;

    function getOsFamily():?string;

    function setNumber($number):self;

    function setSalt($salt):self;

    function setOsVersion($osVersion):self;

    function setOsFamily($osFamily):self;
}
