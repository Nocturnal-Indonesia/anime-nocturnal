<?php
namespace System;

use System\CraynerCore;
use System\ConfigHandler;

/**
*
*		@author Ammar Faizi <ammarfaizi2@gmail.com>
*		@license RedAngel PHP Concept
*
*/
class Controller extends CraynerCore
{
    public function __construct()
    {
        /**
        * Autoload
        */
        $this->autoload(ConfigHandler::iq()->autoload());
        
        /**
        *		Loader
        */
        $this->load = $this;
    }
    
    private function autoload($autoload)
    {
    }
    public function view($view, $___=array())
    {
        foreach ($___ as $____ => $__) {
            $$____ = $__;
        }
        require __DIR__.'/../App/Views/'.$view.'.tpl.php';
    }
    public function helper($helper)
    {
        require __DIR__.'/Helper/'.$helper.'.php';
    }
    public function error($code)
    {
        http_response_code($code);
        $this->load->helper('url');
        $this->load->view('errors/'.$code);
        die;
    }
}
