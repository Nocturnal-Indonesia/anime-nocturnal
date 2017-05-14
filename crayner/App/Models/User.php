<?php
namespace App\Models;

use System\Model;

/**
*		Created by icetea
*/
class User extends Model
{
    /**
    *		Model constructor
    */
    public function __construct()
    {
        parent::__construct();
        parent::db();
    }
    public function get_user_data($id,$by="userid")
    {
        $st = $this->db->prepare("SELECT `a`.`username`,`a`.`email`,`a`.`ukey`,`a`.`authority`,`b`.`nama`,`b`.`tmplahir`,`b`.`tgllahir`,`b`.`alamat`,`b`.`photo` FROM `account_data` AS `a` INNER JOIN `account_info` AS `b` ON `a`.`userid`=`b`.`userid` WHERE `a`.`{$by}`=:id LIMIT 1;");
        $st->execute(array(':id'=>$id));
        return $st->fetch(\PDO::FETCH_ASSOC);
    }
    public function logout()
    {
        if (isset($_COOKIE['id'], $_COOKIE['sess'], $_COOKIE['ukey'])) {
            $st = $this->db->prepare("DELETE FROM `login_session` WHERE `userid`=:userid AND `session`=:session LIMIT 1;");
            $st->execute(array(
                    ':userid'    =>    trim($_COOKIE['id']),
                    ':session'    =>    (teadecrypt($_COOKIE['sess'], teadecrypt($_COOKIE['ukey'], 'redangel')))
                ));
        }
        rmck(array('id','sess','ukey'));
    }
}
