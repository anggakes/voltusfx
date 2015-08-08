<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus_passive {

	/* 
	* parameter model yang digunakan 
	* dalam library Auth terdapat model
	* members dan admins	
	*/

    public $referral;

    public $id_user;

    public $depth;


	public function __construct()
	{
	    $this->load->database();
	    $this->load->model("user_model");
	    $this->load->model("config_model");
	   
	}

	 public function __get($var)
        {
                return get_instance()->$var;
        }

    public function init($referral, $id_user, $depth){
        $this->referral = $referral;
        $this->id_user = $id_user;
        $this->depth = $depth;

        return $this;
    }


    public function check(){

    	$referral = unserialize($this->referral);
    	$member = $referral->getMember();
        $maxNgajak = $this->config_model->getData("bonus_passive_referral")->cnf_value;
        
    	return ($this->depth <= 1  
            AND $member->dataMember->status == "aktif" 
            AND $this->jumlahNgajakBulanIni()<=$maxNgajak) 
            ? true : false;
    }

    public function set(){
    	
        $amount = $this->config_model->getData("bonus_passive_amount")->cnf_value;
    	$referral = unserialize($this->referral);

        return array(
    			"id_referral"   => $referral->dataUser->id,
                "id_user"       => $this->id_user,
                "bonus_type"    => 4,
                "amount"        => $amount,
                "created_at"    => date('Y-m-j H:i:s'),
                "updated_at"    => date('Y-m-j H:i:s'),
                "status"        => 0,
    		);

    }

    public function isNgajakBulanIni(){
        $referral = unserialize($this->referral);
        $member = $referral->getMember();
        $sql = "SELECT * FROM members WHERE id = ? and (last_referral_date = '0000-00-00 00:00:00' OR DATEDIFF(last_referral_date,NOW())<=30)";
        $data = $this->db->query($sql,array($member->dataMember->id))->row();

        return (count($data)>0) ? true : false;
    }

    public function jumlahNgajakBulanIni(){
        
    }

}	