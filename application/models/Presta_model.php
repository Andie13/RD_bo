<?php


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Presta_model extends CI_Model {

    const TABLE_PRESTA = 'prestataires';
    const TABLE_MEDIAS_PRESTA = 'medias_presta';
    
    
    const ID_PRESTA = 'id_presta';
    const NOM_PREST = 'nom_presta';
    const ADRESSE_PRESTA = 'adresse_presta';
    const CP_PRESTA = 'cp_presta';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    
    //FK VILLE ID FK ID_MEDIA
    const ID_VILLE = 'id_ville_presta';
    const ID_MEDIA = 'id_media';
    
    
     public function getAllPresta() {
        $this->db->select()
                ->from(self::TABLE_PRESTA);

        return $data = $this->db->get()->result();
    }
    public function insertPresta($nom,$adresse, $cp, $idVille, $lat, $lng) {
        
       

        $datas = [
            self::NOM_PREST => $nom,
            self::ADRESSE_PRESTA => $adresse,
            self::CP_PRESTA => $cp,
            self::ID_VILLE => $idVille,
            self::LATITUDE => $lat,
            self::LONGITUDE => $lng
        ];

        $this->db->insert(self::TABLE_PRESTA, $datas);
        
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            false;
        }
        
    }
    public function insertMediaPresta($idMedia, $idPresta) {

        $datas = [
            self::ID_MEDIA => $idMedia,
            self::ID_PRESTA => $idPresta,
            
        ];

        $this->db->insert(self::TABLE_MEDIAS_PRESTA, $datas);
        
        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            false;
        }
        
    }
    
} 

