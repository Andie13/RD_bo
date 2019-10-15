<?php

class Medias_model extends CI_Model {

    const TABLE = 'medias';
        const TABLE_MEDIAS_PRESTA = 'medias_presta';
  
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

      public function getAllMediaFromPresta($idPresta) {
        
        $query = $this->db->select()
                ->from(self::TABLE)                
                ->join(self::TABLE_MEDIAS_PRESTA,'medias_presta.id_media = medias.id_media')
                ->where("medias_presta.id_presta = $idPresta");
        
        $medias = $query->get()->result();
        
        if($medias != null){
            return $medias;
        }else{
            return false;
        }
        
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




}
