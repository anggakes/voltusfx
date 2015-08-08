<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member_model extends CI_Model
{

	public $dataMember;

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('wallet_model');
		$this->load->library("bonus/bonuslib");

	}

	public function create($data_member){


		//insert member
		if($this->db->insert('members',$data_member)){

			$id_member = $this->db->insert_id();

			if($this->wallet_model->create($id_member)){

				return true;
			}
		}

		return false;

	}

	public function getData($id_user){

		$model 		= new Member_model();

		$data 	= $this->db->query("SELECT * FROM members WHERE id_user = '$id_user' ")->row();
		
		$model->dataMember = $data;

		return $model;

	}

	public function activation(){

		if($this->bonuslib->run($this->dataMember->id_user)){

			$this->db->where("id",$this->dataMember->id);
			return $this->db->update("members",array(
				"status"=>"trial",
				"activation_at"=>date('Y-m-j H:i:s')
				)); 
		}

		return false;
	}

	public function hasReferral(){

		return ($this->dataMember->id_referral == 0) ? false : true;
	}

	public function getReferral(){
	
			$r = new User_model();
			$referral = $r->getData($this->dataMember->id_referral,"id");	
			
			return $referral;
		
	}

	public function hasDownline($aktif = true){

		$where = ($aktif) ? "AND status = 'aktif'" : "";

		$downline = $this->db->query("SELECT count(*) as banyak FROM members WHERE id_referral = '".$this->dataMember->id."' $where")->row();

		return ($downline->banyak > 0) ? true : false;

	}

	public function getDownline($aktif = true){

		$where = ($aktif) ? "AND status = 'aktif'" : "";

		$downline_data = $this->db->query("SELECT id_user FROM members WHERE id_referral = '".$this->dataMember->id_user."' $where")->result();

		$downline_obj 	= array();

		foreach ($downline_data as $key => $value) {
			$user_model = new User_model;
			$downline_obj[] = $user_model->getData($value->id_user,'id');
		}

		return $downline_obj;
	}

	public function getWallet(){

		return $this->wallet_model->getBalance($this->dataMember->id);
	}


}