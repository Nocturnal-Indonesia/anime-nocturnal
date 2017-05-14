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
class Model extends CraynerCore
{
    public function __construct()
    {
    }
    protected function db()
    {
        $this->db = new Database(ConfigHandler::iq()->db());
    }
}
