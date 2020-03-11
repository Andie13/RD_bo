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

            $userModel = new Users_model();
            $ambassadeurs = $userModel->getAmbassadeurs();

            if ($ambassadeurs != null) {

                $datas['amb'] = $ambassadeurs;
            } else {
                $datas['amb'] = '';
            }



            $this->load->view('layout/sidebar');

            $this->load->view('events/Add_event_view', $datas);
        } else {
            $this->load->view('login/login_view');
        }
    }

    public function addEvent() {



        //get input values
        $nom = $this->input->post('nom');
        $ville = $this->input->post('ville');
        $date = $this->input->post('date');
        $heure = $this->input->post('heure');
		$minutes = $this->input->post('minutes');
        $nbPlaces = $this->input->post('nb_places');
        $age = $this->input->post('age');
        $presta = $this->input->post('presta');
        $prix = $this->input->post('prix');
        $ambassadeursID = $this->input->post('amb');


		$heure = $heure.' h '.$minutes; 
        $userModel = new Users_model();


        //récupération de l'id de la ville
        $theVille = strtok($ville, '__');
        $theCp = substr($ville, strpos($ville, '__') + 2);
        $villeModel = new Villes_model();
        $idVille = $villeModel->getVilleByNameAndCp($theVille, $theCp);

        //traitement de la date
        $date = date('Y-m-d', strtotime($date));

        //vérificaion si l'utilisateur est un ambassadeur
        $idUser = $this->session->id_user;
        if ($this->session->permission == 2) {
            $isAmbassador = TRUE;
        } else {
            $isAmbassador = FALSE;
        }


        //insertion du vouvel event en DB et récupération de l'id de ce dernier.
        $eventModel = new Events_model();
        $eventId = $eventModel->insertNewEvent(
                $nom, $date, $heure, $idVille->id_ville, $nbPlaces, $age, $presta, $prix, $idUser, $isAmbassador);



        //si l'événement a bien été créé
        if (!$eventId == FALSE) {


            //selon specs, un event peut avoir plusieurs ambassadeurs.
            //on va donc inserrer dans la table event_ambassadors tous les ambassadeurs de l'event.
            foreach ($ambassadeursID as $ai) {
                if ($ai > 0) {

                    $res = $eventModel->AddAmbassyToEvent($ai, $eventId);
                    if ($res == FALSE) {
                        //erreur
                        $this->session->set_flashdata('err', "Un problème est survenu, nous n\'avons pas pu entrer tous les ambassadeurs.");
                        redirect('Dashboard_controller');
                    }
                }
            }


            //vérifie qu'un média ai été choisi
            if ($_FILES['logo'] != null) {

                $media = $_FILES['logo'];

                $idMedia = $this->upload($media);


                if ($idMedia != NULL) {
                    $this->addMediaToEvent($eventId, $idMedia);
                } else {
                    //erreur
                    redirect('Dashboard_controller');
                }
            }
        }
    }

    public function addMediaToEvent($idEvent, $idMedia) {

        if ($idEvent != null && $idMedia != null) {

            $eventModel = new Events_model();
            if ($eventModel->addMediaToEvent($idEvent, $idMedia)) {
                //success
            
                 redirect('Dashboard_controller');
            } else {
                //error
            }
        }
    }

    public function upload($media) {


        if (isset($media)) {

//        //si pas d'erreur

            if ($media['error'] == 0) {

                $temp = $media['tmp_name'];
                // reset pic name in case two store insert images with same name
                $mediaName = $media['name'];


                //check format
                $type = $this->checkMediaType($mediaName);
                if (!$type == NULL) {
                    $path = FCPATH . 'uploads';
//                  
                    move_uploaded_file($temp, "$path/$mediaName");

                    $imagePath = base_url() . 'uploads';

                    $mm = new Medias_model();

                    $idMedia = $mm->insertMedia($mediaName, $imagePath, $type);

                    if (!$idMedia == FALSE) {

                        return $idMedia;
                    } else {

                        return NULL;
                    }
                } else {

                    return NULL;
                }
            } else {

                return NULL;
            }
        }
    }

    public function checkMediaType($picNmae) {

        $temp = (explode('.', $picNmae));
        $tempExtExplode = end($temp);
        $ext = strtolower($tempExtExplode);
        if ($ext == "jpg" ||$ext =="JPG" || $ext == "jpeg" || $ext == "png") {
            $typeMedia = 'image';
            return $typeMedia;
        }
        if ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
            $typeMedia = 'video';
            return $typeMedia;
        } else {
            return NULL;
        }
    }

    public function displayEventDetails() {

        $eventId = $this->input->get('id');
        $eventModel = new Events_model();
        $event = $eventModel->getEventDetailsById($eventId);
        $nbresaFromEvent = $eventModel->getNbResaByEventId($eventId);
        $resaDispo = $event->nb_places_event - $nbresaFromEvent;
        $villeModel = new Villes_model();
        $ville = $villeModel->getNomVilleFromId($event->id_ville);




        $amb = $eventModel->getAmbDetailsFromIdEvent($eventId);

        if ($amb != NULL) {
            $amb = $amb;
        } else {

            $amb = '';
        }
        switch ($event->id_tranche_age) {

            case 1:
                $tage = '18 - 25 ans';
                break;
            case 2:
                $tage = '26 - 50 ans';
                break;
            case 3:
                $tage = '50 +';
                break;
            case 4:
                $tage = 'tous';
                break;
        }
        if ($event->image_event != NULL) {

            $mediaModel = new Medias_model();
            $media = $mediaModel->getMediaById($event->image_event);
        } else {
            $media = null;
        }
        $prestaModel = new Presta_model();
        if ($event->id_presta_event != null || $event->id_presta_event != 0) {

            $presta = $prestaModel->getAllPrestaById($event->id_presta_event);
        } else {
            $presta = "A définir";
        }

        //on récupère la liste de tous les prestataires environnants
        $prestaList = $prestaModel->getAllPrestasByDistance($ville->latitude, $ville->longitude);

        switch ($event->id_statut_event) {

            case 1:
                $statut = 'Actif';
                break;
            case 2:
                $statut = 'Annulée';
                break;
            case 3:
                $statut = 'Complet';
                break;
            case 5:
                $statut = 'En attente de prestataire';
                break;
        }
        $statutsModel = new Statuts_model();
        $allStatuts = $statutsModel->getAllStatuts();
        $userModel = new Users_model();


        $imagePath = base_url() . 'uploads/';

        $comments = $eventModel->getCommentsByEventId($event->id_event);

        $ambass = $userModel->getAmbassadeurs();


        $data = array(
            "nom" => $event->nom_event,
            "date" => $event->date_event,
            "heure" => $event->heure_event,
            "ville" => $ville,
            "places" => $event->nb_places_event,
            "age" => $tage,
            "presta" => $presta,
            "prix" => $event->prix_event,
            "media_path" => $imagePath,
            "media" => $media,
            "prestasList" => $prestaList,
            "statut" => $statut,
            "event" => $event,
            "statuts" => $allStatuts,
            "commentaires" => $comments,
            "amb" => $amb,
            "ambass" => $ambass,
            "permission" => $this->session->permission,
            "places_restantes" => $resaDispo
        );


        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');

        $this->load->view('events/edit_event_view', $data);
    }

    public function updateMedia() {

        $media = isset($_FILES['media']) ? $_FILES['media'] : '';
        $idEvent = $this->input->post('id_event');

        if ($media != '') {


            $idMedia = $this->upload($media);


            $eventModel = new Events_model();
            $res = $eventModel->addMediaToEvent($idEvent, $idMedia);


            if ($res) {

                $this->session->set_flashdata('success', "Bravo! Vous avez changé le média de l'évènement");
                redirect("Events_controller/displayEventDetails?id=$idEvent");
            } else {

                $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
                redirect("Events_controller/displayEventDetails?id=$idEvent");
            }
        } else {
            echo 'media null';
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
