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
         $this->load->model("wallet_model");
         $this->load->model("config_model");
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
            $brm = new Bonus_referral();
            $br = $brm->init(serialize($referral), $id_user, $currDepth);
    		if($br->check()) {
    			
    			$this->bonus_queue[] = $br->set();	
    		} 

    		
    		// BONUS GENERATION
            $bgm = new Bonus_generation();
            $bg = $bgm->init(serialize($referral), $id_user, $currDepth);
    		if($bg->check()){

    			$this->bonus_queue[] = $bg->set();
    		}

           
    		// BONUS CONSISTENT
            $bcm = new Bonus_consistent();
    		$bc = $bcm->init(serialize($referral), $id_user, $currDepth);
            if($bc->check()){

                $this->bonus_queue[] = $bc->set();
            }

    		 
    		// BONUS PASSIVE
            $bpm = new Bonus_passive();
    		$bp = $bpm->init(serialize($referral), $id_user, $currDepth);
            if($bp->check()){

                $this->bonus_queue[] = $bp->set();
            }
            
			$depth = $currDepth + 1;
    		$this->crawlUp(serialize($referral), $id_user, $maxDepth, $depth);

    	}

    }

    public function getBonus($id_user, $where=''){
        $data = $this->db->query("SELECT * FROM bonus_queue,users where users.id = bonus_queue.id_user AND id_referral = '$id_user' $where")->result();
          
        return $data;
    }

    

    public function claimAllBonus($id_user, $trial_time){
        $user = $this->user_model->getData($id_user,"id");
        $member = $user->getMember();

        $bonus = $this->getBonus($id_user,"AND status='unclaimed' AND DATEDIFF(NOW(),bonus_queue.created_at) > $trial_time");
        $total_amount  = 0;
        foreach ($bonus as $key => $value) {
            $total_amount += $value->amount;
        }        

        $this->db->trans_start();
        $this->db->where("id_referral",$id_user);
        $this->db->where("status","unclaimed");
        $this->db->where("DATEDIFF(NOW(),bonus_queue.created_at) >",$trial_time);
        $this->db->update("bonus_queue",array("status"=>"claimed"));

        $this->wallet_model->deposit($member->dataMember->id,$total_amount);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }



}