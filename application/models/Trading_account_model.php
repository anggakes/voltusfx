<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Trading_account_model extends CI_Model
{

	public $dataTrading;
	public $id_user;

	public function __construct()
	{

		parent::__construct();
		$this->load->database();

	}

	public function getData($id_user){
		$data = $this->db->query("select * from cancel where id_user='".$id_user."'")->row();
		$this->dataTrading = $data;
		$this->id_user = $id_user;

		return $this;
	}

	public function isInsert(){
		$data = $this->db->query('SELECT count(*) as banyak FROM cancel where id_user ='.$this->id_user)->row();
		return ($data->banyak>0) ? true : false;
	}


}