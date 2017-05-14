<?php
namespace Console\Commands;

defined('REPODIR') or die('REPODIR not defined !');
use Console\ConsoleCore;
use Console\Message;

/**
* @author Ammar Faizi <ammarfaizi2@gmail.com>
*/
class Make extends ConsoleCore
{
    private $what;
    private $file;
    private $option;
    public function __construct($what, $file, $option=null)
    {
        $this->what = $what;
        $this->file = $file;
        $this->option = $option;
    }
    public function run()
    {
        return $this->{$this->what}($this->file, $this->option);
    }
    private function controller($file, $option=null)
    {
        $file = trim($file);
        if (empty($file)) {
            return Message::Error("Masukkan nama controller yang akan dibuat !");
        }
        $fileloc = APPDIR.'Controllers/'.$file.'.php';
        if (file_exists($fileloc)) {
            return Message::Error("Controller \"{$file}\" sudah ada !");
        }
        file_put_contents($fileloc, str_replace('•••controller•••', $file, file_get_contents(REPODIR.'controller.ice')));
        return file_exists($fileloc) ? Message::Success("Berhasil membuat controller \"{$file}\" !") : Message::Error("Gagal membuat controller \"{$file}\" !");
    }
    private function model($file, $option=null)
    {
        $file = trim($file);
        if (empty($file)) {
            return Message::Error("Masukkan nama model yang akan dibuat !");
        }
        $fileloc = APPDIR.'Models/'.$file.'.php';
        if (file_exists($fileloc)) {
            return Message::Error("Model \"{$file}\" sudah ada !");
        }
        file_put_contents($fileloc, str_replace('•••model•••', $file, file_get_contents(REPODIR.'model.ice')));
        return file_exists($fileloc) ? Message::Success("Berhasil membuat model \"{$file}\" !") : Message::Error("Gagal membuat model \"{$file}\" !");
    }
}
