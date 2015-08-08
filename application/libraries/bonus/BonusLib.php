<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BonusLib {

	/* 
	* parameter model yang digunakan 
	* dalam library Auth terdapat model
	* members dan admins	
	*/

	public $bonus_queue = array();

	public function __construct()
	{
	    $this->load->database();
	    $this->load->model("user_model");
	    $this->load->library("bonus/bonus_referral");
        $this->load->library("bonus/bonus_generation");
        $this->load->library("bonus/bonus_consistent");
        $this->load->library("bonus/bonus_passive");
	   
	}

	 public function __get($var)
        {
                return get_instance()->$var;
        }

    public function run($id_user){

    	$u = new User_model();
    	$user = $u->getData($id_user,"id");

    	$this->crawlUp(serialize($user), $user->dataUser->id, 8);

        if(count($this->bonus_queue)>0 AND $this->cekBelumDiproses($user->dataUser->id)){
            
            return $this->db->insert_batch("bonus_queue",$this->bonus_queue);
    	}else {
            
            return false;
        }
    
    }

    public function cekBelumDiproses($id_user){

        $data = $this->db->query("SELECT count(id) as jumlah from bonus_queue WHERE id_user='$id_user'")->row();

            if($data->jumlah == 0 ){
                return true;
            }

                return false;
    }

    public function crawlUp($user, $id_user, $maxDepth, $currDepth=1){

    	$user = unserialize($user);
    	$member = $user->getMember();

    	if($member->hasReferral() and $currDepth <= $maxDepth){

    		$referral = $member->getReferral();
    		
    		// BONUS REFERRAL
            $br = $this->bonus_referral->init(serialize($referral), $id_user, $currDepth);
    		if($br->check()) {
    			
    			$this->bonus_queue[] = $br->set();	
    		} 

    		
    		// BONUS GENERATION
            $bg = $this->bonus_generation->init(serialize($referral), $id_user, $currDepth);
    		if($bg->check()){

    			$this->bonus_queue[] = $bg->set();
    		}

           
    		// BONUS CONSISTENT
    		$bc = $this->bonus_consistent->init(serialize($referral), $id_user, $currDepth);
            if($bc->check()){

                $this->bonus_queue[] = $bc->set();
            }

    		 
    		// BONUS PASSIVE
    		$bp = $this->bonus_passive->init(serialize($referral), $id_user, $currDepth);
            if($bp->check()){

                $this->bonus_queue[] = $bp->set();
            }
			
    		$this->crawlUp(serialize($referral), $id_user, $maxDepth, $currDepth++);

    	}

    }

    



}