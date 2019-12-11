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

	  public function cancelResa() {

        $idResa = $this->input->get('id_resa');
        $idEvent = $this->input->get('id_event');
        
        $em = new Events_model();
        $rm = new Resas_model();
        $event = $em->getEventDetailsById($idEvent);
        $resa = $rm->getResaDetails($idResa);
 
	$this->changeStatusResa($idResa,$idEvent);
	$this->updateCagnotte($resa->id_user,  $event->prix_event,$idEvent);
		 
        
    }

    public function changeStatusResa($resa,$idEvent) {

        $rm = new Resas_model();
        if ($rm->cancelResa($resa)) {
            return TRUE;
        } else {
          $this->session->set_flashdata('err', "Oups! Cette résa a déjà été annulée! ");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
       
      
        }
    }
    public function updateCagnotte($idUser,$prix,$idEvent) {
        
        $um = new Users_model();
        if($um->updateCagnotte($prix,$idUser)){
            $this->session->set_flashdata('success', "la réservation a été annulée avec succès. La cagnotte  de l'utilisateur à été créditée ");
            redirect("Events_controller/displayEventDetails?id=$idEvent");
        }else{
           
       
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

}
