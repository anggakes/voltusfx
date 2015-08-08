<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {


	public function __construct()
		{
		    parent::__construct();


	        $this->load->library('template');
		    $this->load->library('authlibrary');
		    $this->load->library('grocery_CRUD');

	        // untuk mengecek login belum, jika belum di redirect ke login
	        $this->authlibrary->isLogin();
	        
		}

	private function _master(){
		
		$crud = new grocery_CRUD;

		return $crud;
	} 

	public function lists(){
		// restrict accsess
		$this->authlibrary->hasPrivilege("member_lists");

		$crud = $this->_master();

		$crud->set_table('members');
		$crud->set_relation('id_user', 'users', 'username');
		$crud->set_relation('id_referral', 'users', 'username');
		$crud->display_as('id_referral','referral')->display_as('id_user','username');
		$crud->unset_operations();

		$output = $crud->render();
		$output->menu = "member_lists";
		$this->template->load('backend/template','backend/grocery_crud_view',$output);
	}

	public function cancel(){
		// restrict accsess
		$this->authlibrary->hasPrivilege("member_cancel");

		$crud = $this->_master();

		$crud->set_table('cancel');
		$crud->set_relation('id_user', 'users', 'username');
		$crud->display_as('id_referral','referral')->display_as('id_user','username');
		$crud->unset_operations();

		$output = $crud->render();
		$output->menu = "member_cancel";
		$this->template->load('backend/template','backend/grocery_crud_view',$output);
	}

}