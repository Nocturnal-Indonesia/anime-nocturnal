<?php
namespace System;

use System\Crayner_Core;
use System\URISegment;
use System\ConfigHandler;

/**
*
*		@author Ammar Faizi <ammarfaizi2@gmail.com>
*		@license RedAngel PHP Concept
*
*/
class Crayner extends CraynerCore
{
    private $uri;
    private $class;
    private $method;
    public function __construct()
    {
        /**
        * Ambil REQUEST_URI (array)
        */
        $this->uri = URISegment::getURISegments(ConfigHandler::iq()->router());
        
        /**
        * Ambil Segment URI [1] (class)
        */
        $this->class = trim(URISegment::getURISegment(1, $this->uri));
        
        /**
        * Ambil Segment URI [2] (method)
        */
        $this->method = trim(URISegment::getURISegment(2, $this->uri));
        
        /**
        * Index
        */
        if ($this->class=="") {
            $this->class = 'index';
        }
        if ($this->method=="") {
            $this->method = 'index';
        }
    }
    
    /**
    *		Void
    *		Jalankan Crayner
    */
    public function run()
    {
        $class = "App\\Controllers\\{$this->class}";
        if (class_exists($class) and $class = new $class() and is_callable(array($class, $this->method))) {
            $class->{$this->method}();
        } else {
            (new \System\Controller())->error(404);
        }
    }
}
