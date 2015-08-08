<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel extends CI_Controller {

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
        $this->load->model("config_model");
		
		$this->user 	= unserialize($_SESSION['login_user']); 
		$this->member 	= $this->user->getMember();

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");
		$this->_cekTrial();
	}

	public function index(){

		echo "asasas";

	}
	

	public function _cekTrial(){

		if($this->member->dataMember->status != "trial"){
			redirect(base_url("auth/not_allowed"));
		}

		return true;
	}

}