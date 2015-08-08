<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model
{


	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		
	}

	public function getData($name){

		$data = $this->db->query("SELECT * FROM config WHERE name = ?",array($name))->row();
		//var_dump($data);
		return $data;
	}


}