<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        if ($this->session->connected) {


            $datas['userId'] = $this->session->id_user;
            $datas['connected'] = $this->session->connected;
            
            $eventModel = new Events_model();
            
            
           
            if($this->session->permission == 2){
              
                
                 $datas['rows'] = $eventModel->getAllEventFromAmbId($this->session->id_user);
               
                
                
            }else{
                
                $datas['rows'] = $eventModel->getAllEvents();
             }

            
            
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
        $userId = $this->session->id_user;
        
        
        $eventModel = new Events_model();
          
        
        
        $res = $eventModel->deleteEvent($idEvent);
        
         if ($res) {

            $this->session->set_flashdata('success', "L\'évènement a été correctement annulé");
            redirect('Dashboard_controller');
        } else {

            $this->session->set_flashdata('err', "Désolé, vous ne pouvez pas annuler cet event. ");
            redirect("Dashboard_controller");
        }
        
        
        
        
        
    }

}
