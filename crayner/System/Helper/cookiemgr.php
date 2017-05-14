<?php
if (!function_exists('stck')) {
    function stck($ck)
    {
        $domain = (strpos($_SERVER['HTTP_HOST'], 'localhost')===false) ? $_SERVER['HTTP_HOST'] : false;
        $https = isset($_SERVER['HTTPS']) ? true : null;
        $now = time();
        foreach ($ck as $key => $val) {
            $st[] = setcookie($key, $val[0], $now+(int)(isset($val[1])?$val[1]:3600), '/', $domain, $https);
        }
        return $st;
    }
}
if (!function_exists('rmck')) {
    function rmck($ck)
    {
        $domain = (strpos($_SERVER['HTTP_HOST'], 'localhost')===false) ? $_SERVER['HTTP_HOST'] : false;
        $https = isset($_SERVER['HTTPS']) ? true : null;
        foreach ($ck as $val) {
            $st[] = setcookie($val, null, 0, '/', $domain, $https);
        }
        return $st;
    }
}
