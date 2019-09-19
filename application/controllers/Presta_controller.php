<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Presta_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->load->view('layout/header');


        if ($this->session->connected) {


            $datas['userId'] = $this->session->userId;
            $datas['connected'] = $this->session->connected;

//récupération des données à afficher dans la vue.
            $prestaModel = new Presta_model();
            $prestss = $prestaModel->getAllPresta();

            if ($prestss) {
                $datas['prestas'] = $prestss;
            }
            $this->load->view('layout/sidebar');
            $this->load->view('presta/presta_view', $datas);
        } else {
            $this->load->view('login/login_view');
        }
    }

    public function toAddPresta() {

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');

        $this->load->view('presta/add_presta_view');
    }

    public function addPresta() {


        $nom = $this->input->post('nom');
        $rue = $this->input->post('adresse');
        $cp = $this->input->post('cp');
        $ville = $this->input->post('ville');
        $contact = $this->input->post('contact');
        $tel = $this->input->post('tel');

        $theVille = strtok($ville, '__');
        $idVille = substr($ville, strpos($ville, '__') + 2);


//prepare to get lat lng from a place
        $adresse = $rue . ', ' . $cp . ', ' . $theVille;

        $coords = $this->getLatLongFromAdresse($adresse);

        $lat = $coords['latitude'];
        $lng = $coords['longitude'];

        $prestaModel = new Presta_model();
        $idPresta = $prestaModel->insertPresta($nom, $adresse, $cp, $idVille, $lat, $lng, $contact, $tel);

//TEST ID_presta = 8
        if ($idPresta != FALSE) {
            $resps = $this->uploadImage($_FILES['files']);

            foreach ($resps as $idMedia) {

                $prestaModel->insertMediaPresta($idMedia, $idPresta);
            }
        } else {

            echo 'error';
        }


        redirect('Presta_controller');
    }

    public function getLatLongFromAdresse($adresse) {


        $base_url = 'https://maps.googleapis.com/maps/api/geocode/';
        $format = 'xml'; // 'xml' or 'json'
        $address = 'address=' . urlencode($adresse); // makes the text URL friendly, ie, 350+5th+Avenue+New+York%2C+NY 
        $url = $base_url . $format . '?' . $address . '&key=AIzaSyD1SXVeFzbltDLAVktP4baPf1CeBSXcjwM'; // Google requires 'sensor=false' parameter 

        $response = file_get_contents($url);

        $xml = new SimpleXMLElement($response);

        $coords['latitude'] = (string) $xml->result->geometry->location->lat;
        $coords['longitude'] = $xml->result->geometry->location->lng;


        return $coords;
    }

    public function uploadImage($files) {

        $mm = new Medias_model();
        $imagePath = base_url() . 'uploads';
        $path = FCPATH . 'uploads';

        $data = [];
        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {

            if (!empty($_FILES['files']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];


                $fileName = $_FILES['file']['name'];
                $type = $this->checkMediaType($fileName);

                if ($type != FALSE) {
                    move_uploaded_file($_FILES['file']['tmp_name'], "$path/$fileName");


                    $idMedia = $mm->insertMedia($_FILES['file']['name'], $imagePath, $_FILES['file']['type']);

                    if (!$idMedia == FALSE) {

                        $data[$i] = $idMedia;
                    } else {

                        echo ' error pas d\'id media';
                    }
                }
            }
        }
        return $data;
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
        } else {
            return FALSE;
        }
    }

//    TODO request for a new api key for dev environment.
//  API KEY to access geocodes google AIzaSyD1SXVeFzbltDLAVktP4baPf1CeBSXcjwM`

    public function toEditPresta() {

        $idPresta = $this->input->get('id_presta');

        $this->load->view('layout/header');


        if ($this->session->connected) {


//récupération des données à afficher dans la vue.
            $prestaModel = new Presta_model();
            $presta = $prestaModel->getAllPrestaById($idPresta);

            if ($presta != null) {

                $villeModel = new Villes_model();
                $ville = $villeModel->getNomVilleFromId($presta->id_ville_presta);

                $mediaModel = new Medias_model();
                $mediasPresta = $mediaModel->getAllMediaFromPresta($idPresta);

                $comments = $prestaModel->getAllCommentsByIdPresta($idPresta);

                if ($mediasPresta != FALSE) {
                    $datas['mediasPresta'] = $mediasPresta;
                } else {
                    $datas['mediasPresta'] = '';
                }

                if ($comments != null) {
                    $datas['comments'] = $comments;
                } else {
                    $datas['comments'] = "";
                }


                $datas['presta'] = $presta;
                $datas['ville'] = $ville;

                $this->load->view('layout/sidebar');
                $this->load->view('presta/edit_presta_view', $datas);
            } else {
                $this->load->view('login/login_view');
            }
        }
    }

    public function updateDetails() {


        $idPresta = $this->input->post('id_presta');
        $contact = $this->input->post('contact');
        $tel = $this->input->post('tel_contact');



        $prestaModel = new Presta_model();
        $res = $prestaModel->updateContactPresta($idPresta, $contact, $tel);


        if ($res) {

            $this->session->set_flashdata('success', "Vous avez changé le contact de ce prestataire.");
            redirect("Presta_controller/toEditPresta?id_presta=$idPresta");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Presta_controller/toEditPresta?id_presta=$idPresta");
        }
    }

    public function addCommentToPresta() {

        $idPresta = $this->input->post('id_presta');
        $comment = $this->input->post('comment');
        
         $prestaModel = new Presta_model();
         $res = $prestaModel->addCommentToPresta($idPresta, $comment);
         
         if ($res) {

            $this->session->set_flashdata('success', "Le commentaire à bien été rajouté.");
            redirect("Presta_controller/toEditPresta?id_presta=$idPresta");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Presta_controller/toEditPresta?id_presta=$idPresta");
        }
        
    }

}
