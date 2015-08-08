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
	    $this->load->database();
	    $this->load->library('template');
        $this->load->library('authlibrary');
        $this->load->library('session');
        $this->load->model("config_model");
        $this->load->library("form_validation");
		
		$this->user 	= unserialize($_SESSION['login_user']); 
		$this->member 	= $this->user->getMember();

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");
		$this->_cekTrial();
	}

	public function index(){



		$data['user'] = unserialize($_SESSION['login_user']); 
		$data['member'] = $data['user']->getMember();
		
		$data['cancel'] = $this->db->query("select * from cancel where id_user='".$data['user']->dataUser->id."'")->row();
		$data['cancel_msg'] = $this->db->query("select * from cancel_msg where id_cancel='".$data['cancel']->id."'")->result();
		$data['menu'] = "dashboard_member";
		$data['type'] = "send_msg";
		$this->template->load("backend/template","backend/member/cancel/cancel_history",$data);

	}

	public function req($id_cancel=null){
		$type = $this->input->get('type');
		
		if(!isset($type)){
			redirect(base_url("auth/not_allowed"));
		}
		
		$data['user'] 	= unserialize($_SESSION['login_user']); 
		$data['member'] = $data['user']->getMember();
		$data['menu'] 	= "dashboard_member";
		$data['type']	= $type;
		$rule = array(
			array(
	                'field' => 'message',
	                'label' => 'message',
	                'rules' => 'required'
	        ));

		// Form validation 
		$this->form_validation->set_rules($rule);
		if ($this->form_validation->run() == FALSE){
			
			$this->template->load("backend/template","backend/member/cancel/cancel_form",$data);
		
		}else{
			$this->db->trans_start();
			
			if($type == "insert"){

				$this->db->insert("cancel",array(
					"id_user" 	=> $data['user']->dataUser->id,
					"status"	=> 0,
					"created_at"=> date('Y-m-j H:i:s'),
					"updated_at"=> date('Y-m-j H:i:s'),
				));

				$id_cancel = $this->db->insert_id();
			}

				$this->db->insert("cancel_msg",array(
					"id_cancel" 	=> $id_cancel,
					"msg"	=> $this->input->post('message'),
					"created_at"=> date('Y-m-j H:i:s'),
					"by" => "member",
				));

			$this->db->trans_complete();

			if($this->db->trans_status()){

				redirect(base_url("member/cancel"));
			}

		}
	}
	

	public function _cekTrial(){

		if($this->member->dataMember->status != "trial"){
			redirect(base_url("auth/not_allowed"));
		}

		return true;
	}

}