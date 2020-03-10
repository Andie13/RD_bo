<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Update_event_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        echo 'hello';
    }

    public function changeEventPriceNBPlaces() {

        $places = $this->input->post('places');
        $prix = $this->input->post('prix');
        $eventId = $this->input->post('id_event');

        $eventModel = new Events_model();
        $res = $eventModel->updatePlacesPrix($places, $prix, $eventId);

        if ($res) {

            $this->session->set_flashdata('success', "Vos informations ont bien été mises à jour.");
            redirect("Events_controller/displayEventDetails?id=$eventId");
        } else {

            $this->session->set_flashdata('err', "Vos informations n'ont pas été mises à jour.");
            redirect("Events_controller/displayEventDetails?id=$eventId");
        }
    }

    public function changeEventStatus() {

        $idEvent = $this->input->post('id_event');
        $idStatut = $this->input->post('statut');


        $eventModel = new Events_model();
        $res = $eventModel->updateEventStatus($idStatut, $idEvent);

        if ($res) {

            $this->session->set_flashdata('success', "Le statut de l'évènement à bien été mis à jour.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        }
    }

    public function changePrestaEvent() {

        $idEvent = $this->input->post('id_event');
        $idPresta = $this->input->post('presta');

        $eventModel = new Events_model();
        $res = $eventModel->updatePrestaEvent($idEvent, $idPresta);

        if ($res) {

            $this->session->set_flashdata('success', "<le prestataire a bien été mis à jour.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        }
    }

    public function addComment() {

        $idEvent = $this->input->post('id_event');
        $comment = $this->input->post('comment');

        $eventModel = new Events_model();
        $res = $eventModel->insertCommentsToEvent($idEvent, $comment);

        if ($res) {

            $this->session->set_flashdata('success', "le commentaire  a bien été ajouté");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        }
    }

    public function updateAmbassadeurToEvent() {

        $idEvent = $this->input->post('id_event');
        $ambassadeurs = $this->input->post('amb');
        
   

        $eventModel = new Events_model();




        foreach ($ambassadeurs as $ai) {
            if ($ai > 0) {
                
             
//
//                //on retire tous les ambassadeurs préalablement choisis.
               $eventModel->deleteAmbFromEvent($idEvent);

               $res = $eventModel->AddAmbassyToEvent($ai, $idEvent);
            
                if($res) {

                    $this->session->set_flashdata('success', "Les Ambassadeurs ont été modifiés avec succès");
                    redirect("Events_controller/displayEventDetails?id=$idEvent");
                } else {

                    $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
                    redirect("Events_controller/displayEventDetails?id=$idEvent");
                }
           }
        }
    }
	 public function toAddManualResa() {
        $idEvent = $this->input->get('idEvent');

        $eventModel = new Events_model();
        $villeModel = new Villes_model();
        $userModel = new Users_model();

        $event = $eventModel->getEventDetailsById($idEvent);
        $ville = $villeModel->getNomVilleFromId($event->id_ville);
        $users = $userModel->getAllUsers();
        $promos = $eventModel->getAllFromPromo();
        $typePayment = $eventModel->getAllFromTypePaymt();

        $data['event'] = $event;
        $data['ville'] = $ville;
        $data['users'] = $users;
        $data['promo'] = $promos;
        $data['typePayment'] = $typePayment;


        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');

        $this->load->view('events/add_resa_to_event', $data);
    }

    public function addResa() {

        //récupération des valeur du post
        $idEvent = $this->input->post('eventId');
        $userId = $this->input->post('userId');
        $tpePay = $this->input->post('typePay');
        $promo = $this->input->post('promo');
        $prix = $this->input->post('prix');

        $_price = $prix - $prix*$promo;
        //insertion de la résa en base
        $eventModel = new Events_model();
        $res = $eventModel->insertNewReservation($userId, $idEvent,$tpePay,$promo,$_price);

        
        //if reservation was correctly inserted
        if ($res != FALSE) {

            $this->session->set_flashdata('success', "La réservation a été enregistrée avec succès.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        } else {
            $this->session->set_flashdata('err', "Nous n'avons pu mettre inserrer cette réservation.");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        }
    }


}
