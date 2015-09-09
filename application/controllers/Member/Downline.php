<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Downline extends CI_Controller {

	/* 
	* parameter model yang digunakan 
	* dalam library Auth terdapat model
	* members dan admins	
	*/

	public $user;
	public $member;

	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('template');
        $this->load->library('authlibrary');
        $this->load->library('session');
		

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");

        $this->user 	= unserialize($_SESSION['login_user']); 
		$this->member 	= $this->user->getMember();
	   
	}

	public function index(){

		$data['menu'] = "downline";
		$this->template->load('backend/template',"backend/member/downline", $data);	

		
	}


	
}