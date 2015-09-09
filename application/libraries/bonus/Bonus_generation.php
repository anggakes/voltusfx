<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus_generation {

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

    	return ($this->depth <= $this->getMaxDepth()  AND $member->dataMember->status == "aktif") ? 
            true : false;
    }

    public function set(){
    	
        $persen = $this->getNilai()/100; 
    	$amount = $persen * $this->config_model->getData("registration_fee")->cnf_value;
    	$referral = unserialize($this->referral);

        return array(
    			"id_referral"   => $referral->dataUser->id,
                "id_user"       => $this->id_user,
                "bonus_type"    => "Bonus Generation",
                "amount"        => $amount,
                "created_at"    => date('Y-m-j H:i:s'),
                "updated_at"    => date('Y-m-j H:i:s'),
                "status"        => "processed",
    		);

    }

    public function getMaxDepth(){
        $data = $this->db->query("SELECT max(kedalaman) as max FROM bonus_generation")
            ->row();
        return $data->max;
    }

    public function getNilai(){
        $data = $this->db->query("SELECT nilai FROM bonus_generation WHERE kedalaman = ?",
            array($this->depth))->row();
        //var_dump($data);
        return $data->nilai;
    }
}	