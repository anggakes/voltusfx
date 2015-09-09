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
        $this->load->model("config_model");
        $this->load->model("cancel_model");
        $this->load->model("trading_account_model");
		

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");
	   
	}

	public function index(){

		$data['user'] = unserialize($_SESSION['login_user']); 
		$data['member'] = $data['user']->getMember();
		$data['registration_fee'] = $this->config_model->getData("registration_fee")->cnf_value;
		$data['menu'] = "dashboard_member";


		if($data['member']->dataMember->status != "tidak aktif"){
			
			if($this->cancel_model->_sudahCancel($data['user']->dataUser->id) AND $data['member']->dataMember->status == "trial"){
				
				redirect(base_url("member/cancel"));
			}

			$data['trading'] = $this->trading_account_model->getData($data['user']->dataUser->id);
			$this->template->load('backend/template',"backend/member/dashboard/home", $data);	
		}else{
			$this->template->load('backend/template',"backend/member/dashboard/inactive", $data);
		}
		
	}

	
}