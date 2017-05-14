<?php
namespace Console;

use Console\Color\Colors;

/**
*
*/
class Message
{
    public static $ins;
    public function __construct()
    {
        self::$ins = new Colors();
    }
    public static function in()
    {
        if (self::$ins===null) {
            self::$ins = new Colors;
        }
        return self::$ins;
    }
    private static function block($msg)
    {
        $padding = strlen($msg)+10;
        $padding = str_repeat(' ', $padding);
        $spc = str_repeat(' ', 5);
        $msg = $padding.PHP_EOL.($spc.$msg.$spc).PHP_EOL.$padding;
        return $msg;
    }
    public static function Error($msg)
    {
        return self::in()->strclr(self::block($msg), 'white', 'red');
    }
    public static function Success($msg)
    {
        return self::in()->strclr(self::block($msg), 'white', 'green');
    }
}
