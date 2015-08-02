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
        //$this->load->library('user_model');
	   
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
		$rule[] = array(
	                'field' => 'recaptcha_response_field',
	                'label' => 'Captcha',
	                'rules' => array('required',
	                					array(
					                        'check_captcha',
					                        function($str)use($response)
					                        {	
					                        	if ($response['success']) {
												    return true;
												}else {
													return false;
												}
					                        }
					                )
	                			),
	                'errors' => array('check_captcha'=>'maaf captcha salah'));

		$this->form_validation->set_rules('accept_terms_checkbox', '', 'callback_accept_terms');
		$this->form_validation->set_rules($rule);

		// Form validation 
		if ($this->form_validation->run() == FALSE){

				$data['kode_referral'] = $this->uri->segment(3);
				$this->template->load('template/template_auth','auth/register',$data);

		}else{

				if($this->user_model->register() === false){

					echo "terjadi error di server";
				
				}else{
				/*
					$this->authlibrary->sendRegistrationMail(
						$this->input->post('member[email]'), 
						$this->input->post('member[username]'), 
						$this->input->post('member[password]'));
				*/
					redirect(base_url()."auth/success");
				}
		}
	}

	public function success(){

		$this->template->load('template/template_auth','auth/success');
	}

	public function login($role)
	{	
		$data['msg'] = $this->input->get('msg');
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

	public function logout(){

		$this->authlibrary->logout();
		
	}

	public function not_allowed(){
		
		$this->template->load('auth/template','auth/not_allowed');
	}
	
	
	public function get_referral_code($usernameOrRefcode){

		if($usernameOrRefcode != ''){
			
			$data = $this->db->query("SELECT members.status as status_member,members.username,members.code as codex, profile.* FROM members JOIN profile ON members.id = profile.id_member WHERE username = '$usernameOrRefcode' OR code = '$usernameOrRefcode' ")->row();
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
