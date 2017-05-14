<?php
if (!function_exists('teacrypt')) {
    function teacrypt($str, $key='1111111')
    {
        return strrev(base64_encode(gzdeflate(\System\Library\WhiteHat\Encryption\Teacrypt::sgr21cr($str, $key))));
    }
}
if (!function_exists('teadecrypt')) {
    function teadecrypt($str, $key='1111111')
    {
        return \System\Library\WhiteHat\Encryption\Teacrypt::sgr21dr(gzinflate(base64_decode(strrev($str))), $key);
    }
}
