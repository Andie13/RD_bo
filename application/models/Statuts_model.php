<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Statuts_model extends CI_Model {

    const TABLE_STATUT = 'statut';
    const ID_STATUT = 'id_statut';
    const STATUT = 'statut';

    public function getStatusById($idStatut) {

        $this->db->where(self::ID_STATUT, $idStatut)
                ->select()
                ->from(self::TABLE_STATUT);
        
        return $this->db->get()->row();
    }
    public function getAllStatuts() {

        $this->db->select()
                ->from(self::TABLE_STATUT);
        
        return $this->db->get()->result();
    }

}
