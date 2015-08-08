<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

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
        $this->load->model("config_model");
		

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");
	   
	}

	//instant activation function
	public function ia(){

		$user = unserialize($_SESSION['login_user']);
		$member = $user->getMember();

		if($member->activation()){
			$msg = "You have successed your payment, now you are in trial period for ".$this->config_model->getData("trial_time")->cnf_value;
			redirect(base_url("member/home?success=true&message=$msg"));
		}else{
			echo "gagal";
		}

	}

	public function success(){


	}
}