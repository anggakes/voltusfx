<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member_model extends CI_Model
{

	public $dataMember;

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('wallet_model');

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


}