<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

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
        $this->load->model("wallet_model");
        $this->load->model("withdraw_model");
        $this->load->library("form_validation");
		

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");

        $this->user 	= unserialize($_SESSION['login_user']); 
		$this->member 	= $this->user->getMember();
	   
	}

	public function request(){
		$data['user'] = $this->user; 
		$data['member'] = $this->member;
		$data['menu'] = "request_withdraw";

		$rule = array(
			array(
	                'field' => 'amount',
	                'label' => 'message',
	                'rules' => 'required'
	        ));

		// Form validation 
		$this->form_validation->set_rules($rule);

		if ($this->form_validation->run() == FALSE){
			
			$this->template->load('backend/template',"backend/member/withdraw/withdraw_form", $data);
	
		}else{
			
			$amount = $this->input->post('amount');
			$msg = $this->input->post('message');
			$this->db->trans_start();
			$this->db->insert('withdraw',array(
					"id_user" => $this->user->dataUser->id,
					"amount" =>	$amount,
					"msg" => $msg,
					"status" => "processed",
					"created_at" =>date('Y-m-j H:i:s'),
					"updated_at"=>date('Y-m-j H:i:s'),
				));
			
			$this->wallet_model->withdraw($this->member->dataMember->id,$amount);

			$this->db->trans_complete();
			if($this->db->trans_status()){
				$this->session->set_flashdata('sukses', true);
				$this->session->set_flashdata('message', "withdraw success, please wait max 1x24 hour for admin transfer");
				redirect(base_url("member/withdraw/request"));	
			}
			
		}
		
	}

	public function history(){
		$data['user'] = $this->user; 
		$data['member'] = $this->member;
		$data['menu'] = "history_withdraw";
		$data['withdraw'] = $this->withdraw_model->getData($this->user->dataUser->id);

		$this->template->load('backend/template',"backend/member/withdraw/history_withdraw", $data);
	

	}

	
}