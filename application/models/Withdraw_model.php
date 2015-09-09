<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Withdraw_model extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
		$this->load->database();

	}

	public function getData($id_user){
		$data = $this->db->query("select * from withdraw where id_user='".$id_user."'")->result();
		return $data;
	}

	

}