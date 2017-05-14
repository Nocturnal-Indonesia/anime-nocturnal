<?php
namespace App\Controllers;

use System\Controller;

/**
*
*		Created by icetea
*
*/
class home extends Controller
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
            $user = new \App\Models\User();
            $udt = $user->get_user_data($_COOKIE['id']);
            $this->load->view('home', array('u'=>$udt,'l'=>$this));
        } else {
            header('location:'.base_url().'/login?ref=home');
        }
        die;
    }
}
