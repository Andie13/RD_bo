<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->load->view('layout/header');


        if ($this->session->connected) {


            $datas['userId'] = $this->session->userId;
            $datas['connected'] = $this->session->connected;

            //récupération des données à afficher dans la vue.
            $eventModel = new Events_model();
            $tAges = $eventModel->getAllFromTAge();

            if (!$tAges === FALSE) {
                $datas['tages'] = $tAges;
            }
            $presta = $eventModel->getAllFromPresta();

            if (!$presta === FALSE) {
                $datas['prestas'] = $presta;
            }

            $this->load->view('layout/sidebar');

            $this->load->view('events/Add_event_view', $datas);
        } else {
            $this->load->view('login/login_view');
        }
    }

    public function addEvent() {

       
        //get input values
        //get input values
        $nom = $this->input->post('nom');
        $ville = $this->input->post('ville');
        $date = $this->input->post('date');
        $heure = $this->input->post('heure');
        $nbPlaces = $this->input->post('nb_places');
        $age = $this->input->post('age');
        $presta = $this->input->post('presta');
        $prix = $this->input->post('prix');


        //récupération de l'id de la ville
        $theVille = strtok($ville, '__');
        $theCp = substr($ville, strpos($ville, '__') + 2);
        $villeModel = new Villes_model();
        $idVille = $villeModel->getVilleByNameAndCp($theVille, $theCp);

        $date = date('Y-m-d', strtotime($date));   

        //insertion du vouvel event en DB et récupération de l'id de ce dernier.
        $eventModel = new Events_model();
       $eventId = $eventModel->insertNewEvent(
              $nom, $date, $heure, $idVille->id_ville, $nbPlaces, $age, $presta, $prix);

        //si l'événement a bien été créé
       if (!$eventModel == FALSE) {      
           //vérifie qu'un média ai été choisi
            if ($_FILES['logo']!= null) {

                $media = $_FILES['logo'];
                $idMedia = $this->upload($media);
                
                $this->addMediaToEvent($eventId, $idMedia);
              
            }
       }
    }
    
    public function addMediaToEvent($idEvent,$idMedia){
        
        if($idEvent!=null && $idMedia!=null){
            
            $eventModel = new Events_model();
            $eventModel->addMediaToEvent($idEvent, $idMedia);
        }
        
    }

    public function upload($media) {


        if (isset($media)) {

            var_dump($media);
//        //si pas d'erreur

            if ($media['error'] == 0) {

                $temp = $media['tmp_name'];
                // reset pic name in case two store insert images with same name
                $mediaName = $media['name'];


                //check format
                $type = $this->checkMediaType($mediaName);


                $path = FCPATH . 'uploads';
//                  
                move_uploaded_file($temp, "$path/$mediaName");

                $imagePath = base_url() . 'uploads';

                $mm = new Medias_model();
                
                $idMedia = $mm->insertMedia($mediaName, $imagePath, $type);
                
                if (!$idMedia == FALSE) {
                    
                    return $idMedia;
                    
                } else {    
                    
                    echo ' error pas d\'id media';
                }


//             
            } else {

                echo ' error';
            }
        }
    }

    public function checkMediaType($picNmae) {

        $temp = (explode('.', $picNmae));
        $tempExtExplode = end($temp);
        $ext = strtolower($tempExtExplode);
        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
            $typeMedia = 'image';
            return $typeMedia;
        }
        if ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
            $typeMedia = 'video';
            return $typeMedia;
        }
    }

}
