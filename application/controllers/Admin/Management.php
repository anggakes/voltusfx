 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {


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

	public function privileges(){
		// restrict accsess
		$this->authlibrary->hasPrivilege("privileges_management");

		$crud = $this->_master();
		$crud->set_table('privileges');

		$output = $crud->render();
		$output->menu = "privileges_management";
		$this->template->load('backend/template','backend/grocery_crud_view',$output);
	}

	public function roles(){
		// restrict accsess
		$this->authlibrary->hasPrivilege("roles_management");

		$crud = $this->_master();

		$crud->set_table('roles');
		 $crud->set_relation_n_n('privileges', 'role_privilege', 'privileges', 'id_role', 'id_privilege', 'name');

		$output = $crud->render();
		$output->menu = "roles_management";
		$this->template->load('backend/template','backend/grocery_crud_view',$output);
	}

	public function users(){
		// restrict accsess
		$this->authlibrary->hasPrivilege("users_management");

		$crud = $this->_master();

		$crud->set_table('users');
		$crud->set_relation_n_n('roles', 'user_role', 'roles', 'id_user', 'id_role', 'name');
		$crud->unset_columns("password","foto");

		$output = $crud->render();
		$output->menu = "users_management";
		$this->template->load('backend/template','backend/grocery_crud_view',$output);
	}

}