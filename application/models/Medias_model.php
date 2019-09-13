<?php

class Medias_model extends CI_Model {

    const TABLE = 'medias';
  
    const ID = 'id_media';
    
    const NAME = 'nom_media';
    const PATH = 'path_media';
    const TYPE = 'type_media';
   

    /*
     * READ MEDIA
     *       */

    //GET MEDIA BY ID
    public function getMediaById($id) {

       
        $this->db->select()
                ->from(self::TABLE)
                ->where(self::ID, $id);

        return $this->db->get()->row();
    }

    public function get_media_by_Store_id($id) {


        $this->db->select();
        $this->db->from(self::TABLE);
        $this->db->where(self::ID_STORE_MED, $id);

        return $this->db->get()->result_array();
    }

    /*
     * CREATE MEDIA
     *       */

    //CREATE MEDIA 
    public function insertMedia( $name, $path, $type) {

        $mediaDeatilsArray = [ self::NAME => $name, self::PATH => $path, self::TYPE => $type];
        $this->db->insert(self::TABLE, $mediaDeatilsArray);
        $insertedMed = $this->db->insert_id();
        
        if(!$insertedMed == NULL){
             return $insertedMed;
        }else{
            return FALSE;
        }
        
       
        
    }

    /*
     * DEELETE MEDIA
     *       */

    //DELETE MEDIA 
    public function delete_media($id) {
        $this->db->where(self::ID, $id);
        $this->db->delete(self::TABLE);
        if($this->db->affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //DELETE ALL MEDIA FROM 1 STORE
    public function delete_media_from_store_id($store_id) {
        $this->db->where(self::ID_STORE_MED, $store_id);
        $this->db->delete(self::TABLE);
    }

}
