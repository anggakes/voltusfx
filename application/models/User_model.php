<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set("memory_limit","16M");

class User_model extends CI_Model
{

	public $attributes;
	public $profile;



	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		
	}
}