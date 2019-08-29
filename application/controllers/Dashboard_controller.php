<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

    function __construct() {
        parent::__construct();


 
    }

    public function index() {
        
      if ($this->session->connected) {

           
            $datas['userId'] = $this->session->userId;
            $datas['connected'] = $this->session->connected;
            
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('dashboard_view', $datas);
    
            
        } else {
            $this->load->view('login/ligin_view');
        }
    }

    public function logout() {

        $_SESSION['is_connected'] = FALSE;
        redirect('Login_controller', 301);
    }

}
