<?php
namespace System;

/**
*
*       @author Ammar Faizi <ammarfaizi2@gmail.com>
*       @license RedAngel PHP Concept
*
*/
class UriSegment
{
    public static function getUriSegments($router='index.php')
    {
        if (strpos($_SERVER['REQUEST_URI'], $router)!==false) {
            $from = explode($router, $_SERVER['REQUEST_URI']);
            $from = $from[1];
        } else {
            $from = $_SERVER['REQUEST_URI'];
        }
        return explode("/", parse_url($from, PHP_URL_PATH));
    }
    public static function getUriSegment($n, $segs)
    {
        $c = count($segs);
        return isset($segs[$n])&&!empty($segs[$n])?$segs[$n]:'';
    }
}
