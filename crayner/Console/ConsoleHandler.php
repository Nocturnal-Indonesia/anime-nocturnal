<?php
namespace Console;

use Console\ActionHandler;
use Console\Color\Colors;

define('REPODIR', realpath(__DIR__.'/Repositories').'/');
define('APPDIR', realpath(__DIR__.'/../App').'/');
class ConsoleHandler
{
    public function __construct($ar)
    {
        (new Colors());
        $ar[0]=='icetea' or die("\nError verify icetea file !\n");
        count($ar)==1 and $this->info();
        unset($ar[0]);
        $ar = implode(' ', $ar);
        $this->handler = new ActionHandler($ar);
        $this->action = $this->handler->run();
    }
    private function info()
    {
        die;
    }
    public function run()
    {
        exit($this->action);
    }
}
