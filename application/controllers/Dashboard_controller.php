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
            $this->load->view('layout/header');
            $this->load->view('login/login_view');
        }
    }
    public function annulerEvent() {
        
        $idEvent = $this->input->get('id');
        
        $eventModel = new Events_model();
        $res = $eventModel->deleteEvent($idEvent);
        
        if ($res) {
            
                        $this->session->set_flashdata('succes', "L'évènement a été correctement annulé");
                        redirect('Dashboard_controller');
        }
        
        
        
        
        
    }

}
