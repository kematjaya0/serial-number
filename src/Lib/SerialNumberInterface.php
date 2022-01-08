<?php

namespace Kematjaya\SerialNumber\Lib;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface SerialNumberInterface
{
    function getNumber() :?string;

    function getSalt():?string;

    function getOsVersion():?string;

    function getOsFamily():?string;

    function setNumber(?string $number):self;

    function setSalt(?string $salt):self;

    function setOsVersion(?string $osVersion):self;

    function setOsFamily(?string $osFamily):self;
}
