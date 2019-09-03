<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

          $this->load->view('layout/header');


        if ($this->session->connected) {


            $datas['userId'] = $this->session->userId;
            $datas['connected'] = $this->session->connected;

            //récupération des données à afficher dans la vue.
          $userModel = new Users_model();
          $users = $userModel->getAllUsers();

            if ($users) {
                $datas['users'] = $users;
            }
           

            $this->load->view('layout/sidebar');

            $this->load->view('user/Users_view', $datas);
        } else {
            $this->load->view('login/login_view');
        }
        
    }
}
