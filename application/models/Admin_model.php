<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_model extends CI_Model {

    const TABLE_ADMIN = 'bo_admin';
    const PRIMARY_KEY = 'id_admin';
    const ID = 'id_admin';
    const FIRST_NAME = 'firstname_admin';
    const LAST_NAME = 'lastname_admin';
    const EMAIL = 'email_admin';
    const PASSWORD = 'pwd_admin';

    public function get_admin($email, $password) {

        $passwordUser = $this->db->select()
                ->from(self::TABLE_ADMIN)
                ->where(self::EMAIL, $email);
        $row = $passwordUser->get()->row();
       
        
        if (isset($row)) {

            //$hash = password_hash($md5pass,PASSWORD_BCRYPT,  array('const'=>11 ));
//hash est le mot de passe entré en base
            $hash = $row->pwd_admin;
     


            if (password_verify($password, $hash)) {
          
                
                 return $row;
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

}
