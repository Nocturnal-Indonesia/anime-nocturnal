<?php
namespace Console;

class ActionHandler
{
    private $cmd;
    public function __construct($cmd)
    {
        $this->cmd = explode(' ', $cmd);
    }
    public function cmd1($cmd, $sbcmd=null, $arg1=null, $arg2=null)
    {
        $commands = array(
                'make'   => 'Make',
                'delete' => 'Delete',
            );
        $class = "Console\\Commands\\".$commands[$cmd];
        return (new $class($sbcmd, $arg1, $arg2))->run();
    }
    public function run()
    {
        $a = explode(':', $this->cmd[0]);
        if (count($a)==2) {
            return $this->cmd1(
                $a[0],
                (isset($a[1])?$a[1]:null),
                (isset($this->cmd[1])?$this->cmd[1]:null),
                (isset($this->cmd[2])?$this->cmd[2]:null)
            );
        }
    }
}
