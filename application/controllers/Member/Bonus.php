<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends CI_Controller {

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
        $this->load->library("bonus/bonuslib");
		

        $this->authlibrary->isLogin();
        $this->authlibrary->hasPrivilege("member_area");

        $this->user 	= unserialize($_SESSION['login_user']); 
		$this->member 	= $this->user->getMember();
	   
	}

	public function index(){

		$data['bonus'] = $this->bonuslib->getBonus($this->user->dataUser->id, "AND status ='unclaimed'");
		$data['menu'] = "bonus";
		$this->template->load("backend/template", "backend/member/bonus/bonus_list",$data);
	}

	public function history()
	{
		$data['bonus'] = $this->bonuslib->getBonus($this->user->dataUser->id, "AND status ='claimed'");
		$data['menu'] = "bonus";
		$this->template->load("backend/template", "backend/member/bonus/bonus_list",$data);
	}
	public function claimAll(){
		$trial_time = 14;
		$sukses = false;
		$message = " There are nothing bonuses to claim";
		if($this->bonuslib->claimAllBonus($this->user->dataUser->id, $trial_time)){
			$sukses = true;
			$message = " You have success claim your bonus";
			
		}

		$this->session->set_flashdata('sukses', $sukses);
		$this->session->set_flashdata('message', $pesan);
		redirect(base_url('member/bonus'));
	}

	
}