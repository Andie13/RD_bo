<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_model extends CI_Model {

    const TABLE_USERS = 'users';
    const TABLE_PERMISSION = 'permissions';
    const ID_USER = 'id_user';
    const FIRST_NAME = 'firstname_admin';
    const LAST_NAME = 'lastname_admin';
    const EMAIL = 'email_user';
    const PASSWORD = 'pwd_admin';
    const ID_PERMISSION = 'id_perm_user';

    public function get_admin($email, $password) {

        $passwordUser = $this->db->select()
                ->from(self::TABLE_USERS)
                ->where(self::EMAIL, $email);
        $row = $passwordUser->get()->row();

        if (isset($row)) {


            //vérifie les droits de l'tulusateur. S'il est a 3, c'est qu'il n'a pas le droit de rentrer sur le BO
            if ($row->id_perm_user != 3) {

                //mot de passe chiffré en base
                $hash = $row->password_user;

                //on vérifie que les 2 renvoient bien au bon mot de passe
                if (password_verify($password, $hash)) {

                    return $row;
                }
            } else {
                return FALSE;
            }
        }
    }

    public function count_user_by_email($email) {
        $query = $this->db->select('count(id_admin) as find')
                ->from(self::TABLE_ADMIN)
                ->where(self::EMAIL, $email);

        $result = $query->get()->row();

        if ($result != null && isset($result->find) && $result->find == 1) {
            return true;
        } else {
            return false;
        }
    }

    //REAT ADMIN INFORMATION
    public function get_admin_details($id) {
        $column_array = [self::FIRST_NAME, self::LAST_NAME, self::EMAIL];

        $this->db->select()
                ->from(self::TABLE_ADMIN)
                ->where(self::ID, $id);

        return $this->db->get()->row();
    }

    public function insert_new_password($email, $password) {

        $hash = password_hash($password, PASSWORD_BCRYPT, array('const' => 11));

        $this->db->set(self::PASSWORD, $hash)
                ->where(self::EMAIL, $email)
                ->update(self::TABLE_ADMIN);
    }
      public function getAllFromPermissions() {
          
          $this->db->select()
                  ->from(self::TABLE_PERMISSION);
          
          return $this->db->get()->result();
        
    }
    
  

}
