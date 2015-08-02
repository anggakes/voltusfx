<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();

	    $this->load->database();
        $this->load->library('template');
        //$this->load->model('content');
	    
	}//


	public function index()
	{
		
		$data['homepage'] = "data homepage";
		
		$this->template->load('site/template','site/homepage');
	}

	public function halaman($slug){


	}

	public function contact(){

	}

}
