<?php
namespace App\Models;

use System\Model;

/**
*		Created by icetea
*/
class Login extends Model
{
    /**
    *		Model constructor
    */
    public function __construct()
    {
        parent::__construct();
        parent::db();
    }
    public function token()
    {
        $token    = rstr(64);
        $key    = rstr(32);
        $enctk    = teacrypt($token, $key);
        stck(array(
                'lgtoken'    =>    array($enctk,1200),
                'lgkey'        =>    array(teacrypt($key, 'redangel'))
            ));
        return $token;
    }

    public function check_token()
    {
        if (isset($_COOKIE['lgtoken'], $_COOKIE['lgkey'], $_POST['lgtoken']) && teadecrypt($_COOKIE['lgtoken'], teadecrypt($_COOKIE['lgkey'], 'redangel'))==$_POST['lgtoken']) {
            return true;
        }
        return false;
    }
    public function check_login()
    {
        $st = $this->db->prepare("SELECT `userid`,`password`,`ukey`,`authority` FROM `account_data` WHERE `username`=:user LIMIT 1;");
        $st->execute(array(
                ':user'=>$_POST['username']
            ));
        $r = $st->fetch(\PDO::FETCH_ASSOC);
        if ($r && teadecrypt($r['password'], $r['ukey'])==$_POST['password']) {
            $sess = rstr(72-16).$r['userid'];
            $exp = 3600*24*14;
            $now = time();
            $this->db->insert('login_session', array(
                    'userid'    =>$r['userid'],
                    'session'    =>$sess,
                    'login_at'    =>(date('Y-m-d H:i:s', $now)),
                    'expired_at'=>(date('Y-m-d H:i:s', $now+$exp))
                ));
            stck(array(
                    'id'    =>array($r['userid'],$exp),
                    'ukey'    =>array(teacrypt($r['ukey'], 'redangel'),$exp),
                    'sess'    =>array(teacrypt($sess, $r['ukey']),$exp)
                ));
            return true;
        } else {
            return false;
        }
    }

    public function login_status()
    {
        if (isset($_COOKIE['id'], $_COOKIE['ukey'], $_COOKIE['sess'])) {
            $sess = teadecrypt($_COOKIE['sess'], teadecrypt($_COOKIE['ukey'], 'redangel'));
            $st = $this->db->prepare("SELECT `session` FROM `login_session` WHERE `userid`=:userid AND `session`=:session LIMIT 1;");
            $st->execute(array(
                    ':userid'    => $_COOKIE['id'],
                    ':session'    => $sess
                ));
            $r = $st->fetch(\PDO::FETCH_NUM);
            $st = null;
            if ($r) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
