<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/* 
	* parameter model yang digunakan 
	* dalam library Auth terdapat model
	* members dan admins	
	*/


	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('template');
        $this->load->library('authlibrary');
        $this->load->library('session');

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");
	   
	}

	public function index(){
		$data['menu'] = "users_management";
		$this->template->load('backend/template',"backend/member/home", $data);
	}
}