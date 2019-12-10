<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Resas_model extends CI_Model {

    const TABLE_RESA = 'resa';
    const TABLE_EVENT = 'events';
    //concerns user
    const ID_USER = 'id_user';
    const ID_RESA = 'id_resa';
    //for bookings
    const REF_RESA = 'ref_resa';
    const STATUS_RESA = 'status_resa';
    const DATE_RESA = 'date_resa';
    //events
    const ID_EVENT = 'id_event';
    
    
    //get resa from event 
    public function getResasFromEvent($idEvent){
        
         $this->db->where(self::ID_EVENT, $idEvent)               
                ->select()
                ->from(self::TABLE_RESA);

        return $data = $this->db->get()->result();
    }
	
	  public function getResaDetails($idResa) {
         $this->db->where(self::ID_RESA, $idResa)               
                ->select()
                ->from(self::TABLE_RESA);

        return $data = $this->db->get()->row();
        
    }
    public function cancelResa($idResa){
        
        $this->db->where(self::ID_RESA, $idResa) 
                ->set(self::STATUS_RESA,2)
                ->update(self::TABLE_RESA);
        
        if($this->db->affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
