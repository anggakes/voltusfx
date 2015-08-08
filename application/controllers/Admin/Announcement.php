<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends CI_Controller {

	/* 
	* parameter model yang digunakan 
	* dalam library Auth terdapat model
	* members dan admins	
	*/
	protected $params = array('model'=>'admin');

	

	public function __construct()
	{
	    parent::__construct();

        $this->load->library('template');
	    $this->load->library('authlibrary');
	    $this->load->library('grocery_CRUD');

	    	    // untuk mengecek login belum, jika belum di redirect ke login
		$this->authlibrary->isLogin();
	}

    public function index()
    {	
        $this->authlibrary->hasPrivilege("announcement");

    	$crud = new grocery_CRUD;
        $crud->set_table('announcement');
        $crud->columns('isi','created_at','updated_at','status');
        $crud->unset_export();
        $crud->unset_print();
        $crud->unset_texteditor('isi');
        $crud->change_field_type('created_at','invisible');
		$crud->change_field_type('updated_at','invisible');
        $crud->callback_before_insert(array($this,"_timestamp"));

        $output = $crud->render();
        $output->menu="announcement";
        $output->title='Announcement';
       
        $this->template->load('backend/template','backend/grocery_crud_view',$output);

    }

  /*  public function _createnama($data){
         $crud->callback_before_insert(array($this,"_createnama"));   
        $data['nama'] ='isa';
        return $data;
    }*/

    public function _timestamp($data){
    	$data['created_at']=date('Y-m-j H:i:s');
    	return $data;
    }

}