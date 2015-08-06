<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model
{

	public $dataRoles = array();
	public $dataUser;

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('privilege_model');
		$this->load->model('member_model');

		$this->load->library('authlibrary');

	}

	public function getData($val, $by = "username"){

		$user_model 		= new User_model();

		$user 	= $this->db->query("SELECT * FROM users WHERE $by='$val' ")->row();
		$roles   = $this->getRoles($user->id);

		$user_model->dataUser = $user;
		$user_model->dataRoles = $roles;

		return $user_model;

	}

	public function getRoles($id_user){

		$sql = "SELECT t2.* FROM user_role as t1
                JOIN roles as t2 ON t1.id_role = t2.id
                WHERE t1.id_user = ?";
        return $this->db->query($sql, array($id_user))->result();

	}

	public function hasRole($name){

		foreach ($this->dataRoles as $key => $value) {
			if($value->name == $name){
				return true;
			}
		}

		return false;
	}

	public function hasPrivilege($perm){

		foreach ($this->dataRoles as $role) {
			$p = new Privilege_model();
			$privilege = $p->getRolePrivileges($role->id);

            if ($privilege->hasPrivilege($perm)) {
                return true;
            }
        }

        return false;
	}

	public function getMember(){

		if($this->hasRole('member')){

			return $this->member_model->getData($this->dataUser->id);
		}

		return false;
	}

	public function register(){

		
		$this->db->trans_start();

			$data_user['username']		= strtolower($this->input->post('user[username]'));
			$data_user['password']		= $this->authlibrary->hash_password($this->input->post('user[password]'));
			$data_user['email']			= strtolower($this->input->post('user[email]'));
			$data_user['nama']			= ucwords($this->input->post('user[nama]'));
			$data_user['alamat']		= $this->input->post('user[alamat]');
			$data_user['tanggal_lahir']	= $this->input->post('user[tanggal_lahir]');
			$data_user['handphone']		= $this->input->post('user[handphone]');

			$data_user["created_at"]	=  date('Y-m-j H:i:s');
			$data_user["updated_at"]	=  date('Y-m-j H:i:s');


			// insert user -----------------------------------
			$this->db->insert('users',$data_user);
			$id_user = $this->db->insert_id();


					$r = new User_model();
					$referral = $r->getData(
							$this->input->post('username_referral')
						);
			$data_member['id_user'] 	= $id_user;
			$data_member['id_referral']	= $referral->dataUser->id;
			
			//insert member
			$member  = new Member_model();
			$id_member = $member->create($data_member);

			// insert role
			$this->db->insert('user_role',array("id_user"=>$id_user,"id_role"=>2));

		$this->db->trans_complete();

		return $this->db->trans_status();
	}




	public function rules(){

      return array(

	        array(
	                'field' => 'user[username]',
	                'label' => 'Username',
	                'rules' => array('required',
	                				array(
	                						'member_unique_validation',
	                						 function($str)
					                        {
					                                $cek = $this->db->query("SELECT count(*) as valid FROM users WHERE username='$str'")->row();
					                                return ($cek->valid<1) ? true :false;
					                        }
					                )
        						),
	                'errors' => array('member_unique_validation'=>'Username Sudah Terdaftar')
	                		
	        ),
	        array(
	                'field' => 'user[password]',
	                'label' => 'Password',
	                'rules' => 'required',
	        ),
	        array(
                'field' => 'user[repassword]',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[user[password]]'
                
        	),
	        array(
	                'field' => 'member[username_referral]',
	                'label' => 'Username Referral',
	                'rules' => array('required',
					                array(
					                        'referral_code_validation',
					                        function($str)
					                        {
					                                
					                                $cek = $this->db->query("SELECT count(*) as valid FROM users,members WHERE users.username='$str' AND members.id_user = users.id AND members.status = 1")->row();
					                                return ($cek->valid>0) ? true :false;
					                        }
					                )
        						),
	                'errors' => array('referral_code_validation'=>'Kode Refferal yang anda masukkan tidak valid atau Tidak Aktif')        
	        ),
	        array(
	                'field' => 'user[email]',
	                'label' => 'Email',
	                'rules' => array('required',
	                				array(
	                						'email_unique_validation',
	                						 function($str)
					                        {
					                                $cek = $this->db->query("SELECT count(*) as valid FROM users WHERE email='$str'")->row();
					                                return ($cek->valid<1) ? true :false;
					                        }
					                )
        						),
	                'errors' => array('email_unique_validation'=>'Alamat Email Sudah Terdaftar')
	        ),
	        array(
	                'field' => 'user[nama]',
	                'label' => 'Nama',
	                'rules' => 'required'
	        ),
	        array(
	                'field' => 'user[alamat]',
	                'label' => 'Alamat',
	                'rules' => 'required'
	        ),

	        array(
	                'field' => 'user[tanggal_lahir]',
	                'label' => 'Alamat',
	                'rules' => 'required'
	        ),
	      
	        array(
	                'field' => 'user[handphone]',
	                'label' => 'Nomor HP',
	                'rules' => 'required'
	        ),
	        
	       
		);

	}
}