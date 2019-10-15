<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Presta_model extends CI_Model {

    const TABLE_PRESTA = 'prestataires';
    const TABLE_MEDIAS_PRESTA = 'medias_presta';
    const TABLE_COMMENTAIRE_PRESTA = 'commentaire_presta';
    const ID_PRESTA = 'id_presta';
    const NOM_PREST = 'nom_presta';
    const ADRESSE_PRESTA = 'adresse_presta';
    const CP_PRESTA = 'cp_presta';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const CONTACT = 'contact_presta';
    const TEL = 'tel_presta';
    //FK VILLE ID FK ID_MEDIA
    const ID_VILLE = 'id_ville_presta';
    const ID_MEDIA = 'id_media';
    const COMMENT_PRESTA = 'commentaire';

    public function getAllPresta() {
        $this->db->select()
                ->from(self::TABLE_PRESTA);

        return $data = $this->db->get()->result();
    }

    public function getAllPrestaById($id) {

        $this->db->where(self::ID_PRESTA, $id)
                ->select()
                ->from(self::TABLE_PRESTA);

        return $data = $this->db->get()->row();
    }

    public function insertPresta($nom, $adresse, $cp, $idVille, $lat, $lng, $contact, $tel) {



        $datas = [
            self::NOM_PREST => $nom,
            self::ADRESSE_PRESTA => $adresse,
            self::CP_PRESTA => $cp,
            self::ID_VILLE => $idVille,
            self::LATITUDE => $lat,
            self::LONGITUDE => $lng,
            self::CONTACT => $contact,
            self::TEL => $tel
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

    public function getAllPrestasByDistance($latitude, $longitude) {
//         "SELECT *,3956 * 2 * ASIN(SQRT( POWER(SIN(($latitude - latitude) * pi()/180 / 2), 2) + COS($latitude * pi()/180) * COS(latitude * pi()/180) *
//            POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2) )) as
//            distance FROM villes
//            GROUP BY id_ville HAVING distance <= 500 ORDER by distance ASC";
        //SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN((46.216667 - latitude) * pi()/180 / 2), 2) + COS(46.216667 * pi()/180) * COS(latitude * pi()/180) * POWER(SIN((5.6 - longitude) * pi()/180 / 2), 2) )) as distance FROM villes GROUP BY id_ville HAVING distance <= 500 ORDER by distance ASC
//        $latitude = 43.5178;
//        $longitude = 5.4626;
        $distance = "3956 * 2 * ASIN(SQRT( POWER(SIN(($latitude - latitude) * pi()/180 / 2), 2) + COS($latitude * pi()/180) * COS(latitude * pi()/180) *
            POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2) ))";
        $query = $this->db->query("SELECT *, $distance as distance FROM prestataires GROUP BY id_presta HAVING distance <= 50 ORDER by distance ASC");


        return $query->result();
    }

    public function getAllCommentsByIdPresta($idPresta) {

        $this->db->where(self::ID_PRESTA, $idPresta)
                ->select()
                ->from(self::TABLE_COMMENTAIRE_PRESTA);

        return $this->db->get()->result();
    }

    public function updateContactPresta($idPresta, $contact, $tel) {

        $this->db->where(self::ID_PRESTA, $idPresta)
                ->set(self::CONTACT, $contact)
                ->set(self::TEL, $tel)
                ->update(self::TABLE_PRESTA);
        
        if($this->db->affected_rows()>0){
            
            return TRUE;
            
        }else{
            
            return FALSE;
        }
        
    }
    public function addCommentToPresta($idPresta, $comment) {

        $this->db->set(self::ID_PRESTA, $idPresta)
                ->set(self::COMMENT_PRESTA, $comment)
              
                ->insert(self::TABLE_COMMENTAIRE_PRESTA);
        
        if($this->db->affected_rows()>0){
            
            return TRUE;
            
        }else{
            
            return FALSE;
        }
        
    }

}
