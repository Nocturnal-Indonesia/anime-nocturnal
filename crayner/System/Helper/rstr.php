<?php
if (!function_exists('rstr')) {
    function rstr($n=32, $concat='', $clean=null)
    {
        if (isset($clean)) {
            $a = $clean;
        } else {
            $a = "1234567890qwertyuiopasdfghjklzxcvbnm____".$concat;
        }
        $s = strlen($a)-1;
        $rt = '';
        for ($i=0; $i < $n; $i++) {
            $rt .= $a[rand(0, $s)];
        }
        return $rt;
    }
}
