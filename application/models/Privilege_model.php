<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Privilege_model extends CI_Model
{


	public $privileges = array();

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		
	}
 
    // return a role object with associated permissions
    public function getRoleprivileges($id_role) {

        $role = new privilege_model();
        $sql = "SELECT t2.name FROM role_privilege as t1
                JOIN privileges as t2 ON t1.id_privilege = t2.id
                WHERE t1.id_role = ?";
        $p = $this->db->query($sql, array($id_role))->result();
        foreach ($p as $key => $value) {
        	$role->privileges[$value->name] = true; 
        }
        
        return $role;
    }

 
    // check if a permission is set
    public function hasprivilege($privilege) {

        return isset($this->privileges[$privilege]);
    }


}