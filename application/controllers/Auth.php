<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/* 
	* parameter model yang digunakan 
	* dalam library Auth terdapat model
	* members dan admins	
	*/


	public function __construct()
	{
	    parent::__construct();

	    $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->library('authlibrary');
        $this->load->library('session');
        $this->load->library('recaptcha1');
        $this->load->model('user_model');
	   
	}

	public function tes(){

		$this->load->model('user_model');
		$r = new User_model();
		$user = $r->getData(1,'id');

		var_dump($user->hasPrivilage('edit_user'));
	}


	function accept_terms()
	{
		//if (isset($_POST['accept_terms_checkbox']))
            if ($this->input->post('accept_terms_checkbox'))
		{
			return TRUE;
		}
		else
		{
			$error = 'Anda belum menyetujui syarat dan kondisi kami';
			$this->form_validation->set_message('accept_terms', $error);
			return FALSE;
		}
	}

	public function register()
	{	
		$this->recaptcha = new Recaptcha1();

		$captcha_answer["recaptcha_challenge_field"] = $this->input->post('recaptcha_challenge_field');
		$captcha_answer["recaptcha_response_field"] = $this->input->post('recaptcha_response_field');
		/*
			Untuk captcha 2
			$captcha_answer = $this->input->post('g-recaptcha-response');
		*/
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		$rule = $this->user_model->rules();
		$rule[] = $this->recaptcha->rule($response);

		$this->form_validation->set_rules('accept_terms_checkbox', '', 'callback_accept_terms');
		$this->form_validation->set_rules($rule);

		// Form validation 
		if ($this->form_validation->run() == FALSE){

				$data['kode_referral'] = $this->uri->segment(3);
				$this->template->load('auth/template','auth/register',$data);

		}else{

				if($this->user_model->register() === false){

					echo "terjadi error di server";
				
				}else{
				/*	
					$this->load->library("sendregistrationmail");
					$this->sendregistrationmail->send($email,$data);
				*/
					redirect(base_url()."auth/success");
				}
		}

	}

	public function success(){

		$this->template->load('auth/template','auth/success');
	}

	public function login($role=null)
	{	
		//redirect ke login member jika role tidak di set
		if(!isset($role)){
            redirect(base_url()."auth/login/member");
        }

		$data['message'] = $this->input->get('message');
		$data['success'] = $this->input->get('success');
		$rules 		=  array(
				array(
	                'field' => 'usernameOrEmail',
	                'label' => 'Username',
	                'rules' => 'required'
		        ),
		        array(
	                'field' => 'password',
	                'label' => 'Password',
	                'rules' => 'required',
		        ),
			);
		$this->form_validation->set_rules($rules);

		// Form validation 
		if ($this->form_validation->run() == FALSE){

				$data['role'] = $role;
				$this->template->load('auth/template','auth/login', $data);

		}else{

				$usernameOrEmail 	= $this->input->post('usernameOrEmail');
				$password 			= $this->input->post('password');

				$this->authlibrary->login($usernameOrEmail, $password, $role);
				
		}

	} 

	public function logout($role=null){
		
		if(!isset($role)){
            show_404();
        }

		$this->authlibrary->logout($role);
		
	}

	public function not_allowed(){
		
		$this->template->load('auth/template','auth/not_allowed');
	}
	
	
	public function get_referral_code($usernameOrRefcode){

		if($usernameOrRefcode != ''){
			
			$data = $this->db->query("SELECT members.status as status_member, users.* FROM users JOIN members ON users.id = members.id_user WHERE users.username = '$username' ")->row();
			if(count($data)>0){
				$alamat_foto = ($data->foto != '') ? $data->foto : "default.png";
				$data->foto = "<img src='".base_url()."foto_profil/$alamat_foto' class='img-circle' style='width:80px' />";
				$data->success = true;
			}else{
				$data = new stdClass();
				$data->success = false;
			}
			echo json_encode($data);

		}
	}

	public function forget_password(){
		$rules 		=  array(
				array(
	                'field' => 'usernameOrEmail',
	                'label' => 'Username',
	                'rules' => 'required'
		        ),
			);
		$this->form_validation->set_rules($rules);

		// Form validation 
		if ($this->form_validation->run() == FALSE){

				$data['status'] = "kirim_token";
				$this->template->load('auth/template','auth/forget_password',$data);

		}else{

				$usernameOrEmail 	= $this->input->post('usernameOrEmail');

				if($this->authlibrary->set_forget_password($usernameOrEmail)){
					$data['status'] = "sukses_kirim";
					$this->template->load('auth/template','auth/forget_password',$data);
				}else{
					$data['status'] = "gagal_kirim";
					$this->template->load('auth/template','auth/forget_password',$data);
				}
		}

	}

	public function proses_forget_password(){

		$rules 		=  array(
				 array(
	                'field' => 'password',
	                'label' => 'Password',
	                'rules' => 'required',
		        ),
		        array(
	                'field' => 'repassword',
	                'label' => 'Password Confirmation',
	                'rules' => 'required|matches[password]'
	                
	        	),
			);



		$this->form_validation->set_rules($rules);

		$k = $this->input->get("k");
		$u = $this->input->get("u");
		// Form validation 
		if ($this->form_validation->run() == FALSE){

				$data['status'] = "proses";
				$data['u'] = $u;
				$data['k'] = $k;
				$this->template->load('auth/template','auth/forget_password',$data);

		}else{
				

				$newPassword 	= $this->input->post('password');

				if($this->authlibrary->get_forget_password($k, $u, $newPassword)){

					$data['status'] = "proses_ok";
					$this->template->load('template/template_auth','auth/forget_password',$data);

				}else{

					$data['status'] = "proses_gagal";
					$this->template->load('template/template_auth','auth/forget_password',$data);
				}
				
		}

	}


}
