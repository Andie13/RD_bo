<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model {

    const TABLE_USERS = 'users';
    const TABLE_GENRES = 'genres';
//concerns user 
    const ID_USER = 'id_user';
    const GENRE_USER = 'genre_user';
    const NOM_USER = 'nom_user';
    const PRENOM_USER = 'prenom_user';
    const EMAIL_USER = 'email_user';
    const ANNIV_USER = 'anniv_user';
    const CREATED_USER = 'created_user';
    const MODIFIED_USER = 'modified_user';
    //for bookings
    const REF_RESA = 'ref_resa';
    const STATUS_RESA = 'status_resa';
    const DATE_RESA = 'date_resa';
//    FK to table tranches_age
    const ID_TRANCHE_AGE = 'id_tranche_age';
    //genre
    const ID_GENRE = 'id_genre';
    const NOM_GENRE = 'nom_genre';

    public function getAllUsers() {
        $this->db->select()
                ->from(self::TABLE_USERS);

        return $data = $this->db->get()->result();
    }

}
