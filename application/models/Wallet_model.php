<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallet_model extends CI_Model
{


	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('member_model');
	}

	public function create($id_member){
	
		return $this->db->insert('wallet', array(
				"id_member" => $id_member,
				"balance"	=> 0,
				));
	}

	public function deposit($id_member, $amount){

		$this->db->set("balance", "balance + ".(int) $amount,false);
		$this->db->where('id_member',$id_member);
		return $this->db->update("wallet");

	}

	public function withdraw($id_member, $amount){

		$this->db->set("balance", "balance - ".(int) $amount, false);
		$this->db->where('id_member',$id_member);
		return $this->db->update("wallet");
	}
	
	public function getBalance($id_member){

		$data = $this->db->query("SELECT balance FROM wallet WHERE id_member = ".$id_member)->row();
		return $data->balance;
	}

}