<?php
namespace App\Controllers;

use System\Controller;

/**
*
*		Created by icetea
*
*/
class register extends Controller
{
    /**
    * Controller constructor
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('rstr');
        $this->load->helper('assets');
        $this->load->helper('teacrypt');
        $this->load->helper('cookiemgr');
    }
    
    /**
    * Default method
    */
    public function index()
    {
        $login = new \App\Models\Login();
        if ($login->login_status()) {
            $this->load->error(404);
        } else {
            unset($login);
            $register = new \App\Models\Register();
            $this->saved_post = $register->get_saved_post();
            $this->load->view('register', array('tanggal_lahir'=>$this->tanggal_lahir(),'rgtoken'=>$register->token(),'ps'=>$this->saved_post));
        }
    }
    public function action()
    {
        $register = new \App\Models\Register();
        $register->save_post();
        if ($register->check_token()) {
            if ($register->validate_input()) {
                $register->register_to_db();
                header('location:'.base_url().'/register/success');
            } else {
                stck(array('alert'=>array(teacrypt($register->get_alert(), 'redangel'),300)));
                header('location:'.base_url().'/register?ref=reg_action&get_alert=true');
            }
        } else {
            $this->error_token();
        }
        die('end of action');
    }
    public function success()
    {
    }
    private function tanggal_lahir()
    {
        $a = '<select required name="tanggal"><option></option>';
        if (isset($this->saved_post['tanggal'])) {
            for ($i=1; $i <= 31; $i++) {
                $a.='<option '.($this->saved_post['tanggal']==$i?'selected':'').'>'.$i.'</option>';
            }
        } else {
            for ($i=1; $i <= 31; $i++) {
                $a.='<option>'.$i.'</option>';
            }
        }
        $a .= '</select>';
        $a.= '<select required name="bulan"><option></option>';
        $bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $i = 1;
        if (isset($this->saved_post['bulan'])) {
            foreach ($bln as $val) {
                $a.='<option value="'.($i).'" '.($this->saved_post['bulan']==$i++?'selected':'').'>'.$val.'</option>';
            }
        } else {
            foreach ($bln as $val) {
                $a.='<option value="'.($i++).'">'.$val.'</option>';
            }
        }
        
        $a.='</select>';
        $a.= '<select required name="tahun"><option></option>';
        if (isset($this->saved_post['tahun'])) {
            for ($i=(int)date('Y');$i>=1965;$i--) {
                $a.='<option'.($this->saved_post['tahun']==$i?' selected':'').'>'.($i).'</option>';
            }
        } else {
            for ($i=(int)date('Y');$i>=1965;$i--) {
                $a.='<option>'.($i).'</option>';
            }
        }
        return $a.'</select>';
    }

    private function error_token()
    {
        header('location:'.base_url().'/register?ref=err_token'); ?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Error Token !</title>
		</head>
		<body>
			<h1>Error Token !</h1>
		</body>
		</html>
		<?php

    }
    private function error_validate()
    {
    }
}
