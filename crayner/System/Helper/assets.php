<?php
use System\ConfigHandler;

if (!function_exists('js')) {
    function js($file, $abs=false)
    {
        print '<script type="text/javascript" src="'.(ConfigHandler::iq()->assets('js')).'/'.($abs?$file:$file.'.js').'?t='.time().'"></script>'."\n";
    }
}
if (!function_exists('css')) {
    function css($file, $abs=false)
    {
        print '<link rel="stylesheet" type="text/css" href="'.(ConfigHandler::iq()->assets('css')).'/'.($abs?$file:$file.'.css').'?t='.time().'">'."\n";
    }
}
