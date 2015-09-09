<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cancel_model extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
		$this->load->database();

	}

	public function getData($id_user){
		$data = $this->db->query("select * from cancel where id_user='".$id_user."'")->row();
		$data->status = $this->ubahStatus($data->status);
		return $data;
	}

	public function getMsg($id_cancel){
		$data =  $this->db->query("select * from cancel_msg where id_cancel='".$id_cancel."' ORDER BY created_at desc")->result();
		return $data;
	}

	public function _sudahCancel($id_user){
		$data = $this->db->query('SELECT count(*) as banyak FROM cancel where id_user ='.$id_user)->row();
		return ($data->banyak>0) ? true : false;
	}

	public function ubahStatus($status){
		$return = '';
		switch ($status) {
			case 0:
				$return = "diajukan";
				break;
			case 1:
				$return = "disetujui dan diproses";
				break;
			case 2:
				$return = "Selesai";
				break;
			case -1:
				$return = "ditolak";
				break;
		}

		return $return ;
	}

}