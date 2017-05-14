<?php
namespace App\Controllers;

use System\Controller;

/**
*
*		Created by icetea
*
*/
class logout extends Controller
{
    /**
    * Controller constructor
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('rstr');
        $this->load->helper('cookiemgr');
        $this->load->helper('teacrypt');
    }
    
    /**
    * Default method
    */
    public function index()
    {
        $user = new \App\Models\User();
        $user->logout();
        header('location:'.base_url().'/?ref=logout&w='.urlencode(rstr(64)));
        die('logout');
    }
}
