<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Villes_model extends CI_Model {

    const TABLE_VILLES = 'villes';
    const ID_VILLE = 'id_ville';
    const NOM_REGION = 'nom_region';
    const NUMERO_DEPARTEMENT = 'nom_departement';
    const NOM_COMMUNE = 'nom_commune';
    const CODE_POSTAL = 'code_postal';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';

    public function getVilles($string) {

        $this->db->select(self::NOM_COMMUNE)
                ->distinct(self::NOM_COMMUNE)
                ->like(self::CODE_POSTAL, $string)
                ->from(self::TABLE_VILLES);
        return $data = $this->db->get()->result();
    }

    public function getVilleDetails($ville) {
        $this->db->where(self::NOM_COMMUNE, $ville)
                ->select()
                ->from(self::TABLE_VILLES);
        return $this->db->get()->row();
    }

    public function getVillesByDistance($latitude, $longitude) {
//         "SELECT *,3956 * 2 * ASIN(SQRT( POWER(SIN(($latitude - latitude) * pi()/180 / 2), 2) + COS($latitude * pi()/180) * COS(latitude * pi()/180) *
//            POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2) )) as
//            distance FROM villes
//            GROUP BY id_ville HAVING distance <= 500 ORDER by distance ASC";
        //SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN((46.216667 - latitude) * pi()/180 / 2), 2) + COS(46.216667 * pi()/180) * COS(latitude * pi()/180) * POWER(SIN((5.6 - longitude) * pi()/180 / 2), 2) )) as distance FROM villes GROUP BY id_ville HAVING distance <= 500 ORDER by distance ASC
//        $latitude = 43.5178;
//        $longitude = 5.4626;
        $distance = "3956 * 2 * ASIN(SQRT( POWER(SIN(($latitude - latitude) * pi()/180 / 2), 2) + COS($latitude * pi()/180) * COS(latitude * pi()/180) *
            POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2) ))";
        $query = $this->db->query("SELECT *, $distance as distance FROM villes GROUP BY id_ville HAVING distance <= 50 ORDER by distance ASC");


        return $query->result();
    }

    public function getNomVilleFromId($id) {
        $this->db->select(self::NOM_COMMUNE) 
                ->where(self::ID_VILLE, $id)
                        ->from(self::TABLE_VILLES);

        return $this->db->get()->row();
    }
    
    public function getVilleByNameAndCp($theVille,$theCp) {
        
        $this->db->select() 
                ->where(self::NOM_COMMUNE , $theVille)
                ->where(self::CODE_POSTAL,$theCp)
                        ->from(self::TABLE_VILLES);

        return $this->db->get()->row();
    }

}
