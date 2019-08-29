<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model {

    const TABLE_USERS = 'users';
    const TABLE_GENRES = 'genres';
    const ID_GENRE = 'id_genre';
    const NOM_GENRE = 'nom_genre';
    const ID_USER = 'id_user';
    const GENRE_USER = 'genre_user';
    const NOM_USER = 'nom_user';
    const PRENOM_USER = 'prenom_user';
    const EMAIL_USER = 'email_user';
    const PASSWORD_USER = 'password_user';
    const ANNIV_USER = 'anniv_user';
    const CREATED_USER = 'created_user';
    const MODIFIED_USER = 'modified_user';

    public function registerUser($genre, $nom, $prenom, $email, $pass, $anniv) {

        //récupération et chiffrement du mot de passe préalablement hashé.
        $hash = password_hash($pass, PASSWORD_BCRYPT, array('const' => 11));
        $data = [
            self::GENRE_USER => $genre,
            self::NOM_USER => $nom,
            self::PRENOM_USER => $prenom,
            self::EMAIL_USER => $email,
            self::PASSWORD_USER => $hash,
            self::ANNIV_USER => $anniv,
            self::CREATED_USER => date('Y-m-d H:i:s')];

        $this->db->insert(self::TABLE_USERS, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id;
        } else {
            false;
        }
    }

    public function loginUser($email, $password) {

        $passwordUser = $this->db->select()
                ->from(self::TABLE_USERS)
                ->where(self::EMAIL_USER, $email);

        $row = $passwordUser->get()->row();
        if (isset($row)) {

            //hash est le mot de passe entré en base
            $hash = $row->password_user;

            if (password_verify($password, $hash)) {


                return $row;
            } else {
                return FALSE;
            }
        }
    }

    public function checkIfUserEvists($email) {
        $query = $this->db->select('count(id_user) as find')
                ->from(self::TABLE_USERS)
                ->where(self::EMAIL_USER, $email);

        $result = $query->get()->row();

        if ($result != null && isset($result->find) && $result->find > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function changePassword($email, $password) {

        $hash = password_hash($password, PASSWORD_BCRYPT, array('const' => 11));

        $this->db->set(self::PASSWORD_USER, $hash)
                ->where(self::EMAIL_USER, $email)
                ->update(self::TABLE_USERS);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            $this->db->error_message();
        }
    }

    public function getUserById($id) {


        $query = $this->db->select()
                ->from(self::TABLE_USERS)
                ->where(self::ID_USER, $id);

        $result = $query->get()->row();
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function changeEmailFromUser($id, $email) {

        $this->db->set(self::EMAIL_USER, $email)
                ->where(self::ID_USER, $id)
                ->update(self::TABLE_USERS);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            $this->db->error_message();
        }
    }

    public function getGenreNameById($id) {

        $query = $this->db->select()
                ->where(self::ID_GENRE, $id)
                ->from(self::TABLE_GENRES);

        $result = $query->get()->row();
        if ($result) {
            
          
            return $result;
        } else {
            return FALSE;
        }
    }

}
