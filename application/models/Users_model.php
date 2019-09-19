<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model {

    const TABLE_USERS = 'users';
    const TABLE_GENRES = 'genres';
    const TABLE_RESA = 'resa';
    const TABLE_COMMENTS_USERS = 'comments_users';
//concerns user 
    const ID_USER = 'id_user';
    const GENRE_USER = 'genre_user';
    const NOM_USER = 'nom_user';
    const PRENOM_USER = 'prenom_user';
    const EMAIL_USER = 'email_user';
    const PASSWORD_USER = 'password_user';
    const CREATED_USER = 'created_user';
    const TEL_USER = 'tel_user';
    const ANNIV_USER = 'anniv_user';
    const MODIFIED_USER = 'modified_user';
    const ID_PERM_USER = 'id_perm_user';
    //for bookings
    const REF_RESA = 'ref_resa';
    const STATUS_RESA = 'status_resa';
    const DATE_RESA = 'date_resa';
//    FK to table tranches_age
    const ID_TRANCHE_AGE = 'id_tranche_age';
    //genre
    const ID_GENRE = 'id_genre';
    const NOM_GENRE = 'nom_genre';
    
    const COMMENTAIRE = 'commentaire';

    public function getAllUsers() {
        $this->db->select()
                ->from(self::TABLE_USERS);

        return $data = $this->db->get()->result();
    }
    public function getResasByUserId($userId) {
        
        $this->db->where(self::ID_USER,$userId)
                ->select()
                ->from(self::TABLE_RESA);
        
        return $this->db->get()->result();
        
        
    }
    public function getUserById($idUser) {
        
        $this->db->where(self::ID_USER,$idUser)
                ->select()
                ->from(self::TABLE_USERS);
        return $this->db->get()->row();
        
    }
    
    public function getCommentsFromUser($usserId) {
        
        $this->db->where(self::ID_USER,$usserId)
                ->select()
                ->from(self::TABLE_COMMENTS_USERS);
        
        return $this->db->get()->result();
        
    }
    
    public function insertUserComment($idUser, $comment) {
        
        $this->db->set(self::ID_USER, $idUser)
                ->set(self::COMMENTAIRE, $comment)
                ->insert(self::TABLE_COMMENTS_USERS);
        
        if($this->db->affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
      public function updateUserRole($idUser, $idPerm) {
        
        $this->db->where(self::ID_USER,$idUser)
                ->set(self::ID_PERM_USER, $idPerm)
                ->update(self::TABLE_USERS);
        
        if($this->db->affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
      public function registerUser( $nom, $prenom, $email,$tel,$pass, $role) {

        //récupération et chiffrement du mot de passe préalablement hashé.
        $hash = password_hash($pass, PASSWORD_BCRYPT, array('const' => 11));
        $data = [
           
            self::NOM_USER => $nom,
            self::PRENOM_USER => $prenom,
            self::EMAIL_USER => $email,
            self::TEL_USER => $tel,
            self::PASSWORD_USER => $hash,
            self::ID_PERM_USER => $role,
            self::CREATED_USER => date('Y-m-d H:i:s')];

        $this->db->insert(self::TABLE_USERS, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            false;
        }
    }
   
    
    
    

}
