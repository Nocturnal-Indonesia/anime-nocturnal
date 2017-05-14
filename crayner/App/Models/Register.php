<?php
namespace App\Models;

use System\Model;

/**
*		Created by icetea
*/
class Register extends Model
{
    /**
    *		Model constructor
    */
    private $alert;
    public function __construct()
    {
        parent::__construct();
        parent::db();
    }
    public function token()
    {
        $token    = rstr(64);
        $key    = rstr(32);
        $enctok    = teacrypt($token, $key);
        stck(array(
                'rgtoken'    => array($enctok,3600),
                'rgkey'        => array(teacrypt($key, 'redangel'),3600),
            ));
        return $token;
    }
    public function check_token()
    {
        if (isset($_COOKIE['rgtoken'], $_COOKIE['rgkey'], $_POST['rgtoken']) && teadecrypt($_COOKIE['rgtoken'], teadecrypt($_COOKIE['rgkey'], 'redangel'))==$_POST['rgtoken']) {
            return true;
        } else {
            return false;
        }
    }
    public function save_post()
    {
        if (isset($_POST['register'])) {
            stck(array(
                    'psfl'    => array(teacrypt(json_encode($_POST), 'redangel'),500)
                ));
        }
    }
    public function get_saved_post()
    {
        if (isset($_COOKIE['psfl'])) {
            return json_decode(teadecrypt($_COOKIE['psfl'], 'redangel'), true);
        }
        return array();
    }
    public function is_exists_on_db($table, $field, $value)
    {
        $st = $this->db->prepare("SELECT COUNT(`{$field}`) FROM `{$table}` WHERE `{$field}`=:{$field} LIMIT 1;");
        $st->execute(array(':'.$field=>$value));
        $dt = $st->fetch(\PDO::FETCH_NUM);
        return (bool)$dt[0];
    }
    private static function vtr($str)
    {
        return trim(strtolower($str));
    }
    public function validate_input()
    {
        $username   = self::vtr($_POST['username']);
        $email      = self::vtr($_POST['email']);
        $phone      = self::vtr($_POST['phone']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->alert = "E-Mail salah !";
            return false;
        } elseif (strlen($username)<4) {
            $this->alert = "Username terlalu pendek, minimal 4 digit !";
            return false;
        } elseif (strlen($username)>64) {
            $this->alert = "Username terlalu panjang, maksimal 64 digit !";
            return false;
        } elseif (strlen($_POST['password'])<6) {
            $this->alert = "Password terlalu pendek, minimal 6 digit !";
            return false;
        } elseif (strlen($_POST['password'])>225) {
            $this->alert = "Password terlalu paanjang, maksimal 225 digit !";
            return false;
        } elseif ($_POST['password']!=$_POST['cpassword']) {
            $this->alert = "Konfirmasi Password tidak sama !";
            return false;
        } elseif ($this->is_exists_on_db('account_data', 'username', $username)) {
            $this->alert = "Username sudah digunakan anggota lain !";
            return false;
        } elseif ($this->is_exists_on_db('account_data', 'email', $email)) {
            $this->alert = "Email sudah digunakan anggota lain !";
            return false;
        } elseif ($this->is_exists_on_db('account_info', 'phone', $phone)) {
            $this->alert = "Nomor sudah digunakan anggota lain !";
            return false;
        }
        return true;
    }
    public function get_alert()
    {
        return $this->alert;
    }
    private function generate_userid()
    {
        do {
            $userid = rand(1, 9).rstr(15, null, '1234567890');
        } while ($this->is_exists_on_db('account_data', 'userid', $userid));
        return $userid;
    }
    public function register_to_db()
    {
        $userid = $this->generate_userid();
        $ukey    = rstr(72-16).$userid;
        $this->db->insert('account_data', array(
                'userid'    =>    $userid,
                'username'    =>    trim(strtolower($_POST['username'])),
                'email'        =>    trim(strtolower($_POST['email'])),
                'password'    =>    teacrypt($_POST['password'], $ukey),
                'ukey'        =>    $ukey,
                'authority'    =>    'user'
            ));
        $this->db->insert('account_info', array(
                'userid'    =>    $userid,
                'nama'        =>    ucwords(trim(strtolower($_POST['nama']))),
                'tmplahir'    =>    trim($_POST['tmplahir']),
                'tgllahir'    =>    ($_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tanggal']),
                'alamat'    =>    trim($_POST['alamat']),
                'phone'        =>    trim($_POST['phone']),
                'tgldaftar'    =>    (date('Y-m-d H:i:s'))
            ));
    }
}
