<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Events_model extends CI_Model {

    const TABLE_EVENT = 'events';
    const TABLE_PAYMENT = 'payments';
    const TABLE_RESA = 'resa';
    const TABLE_TAGE = 'tranches_age';
    const TABLE_PRESTA = 'prestataires';
    const TABLE_STATUT_EVENT = 'statut_event';
    const TABLE_COMMENTAIRES_EVENT = 'commentaires_event';
    const TABLE_AMBASSADEUR_EVENT = 'ambassadeurs_event';
    //concerns user
    const ID_USER = 'id_user';
    //for bookings
    const REF_RESA = 'ref_resa';
    const STATUS_RESA = 'status_resa';
    const DATE_RESA = 'date_resa';
    //events
    const ID_EVENT = 'id_event';
    const DATE_EVENT = 'date_event';
    const HEURE_EVENT = 'heure_event';
    const NB_PLACE_EVENT = 'nb_places_event';
    const IMAGE_EVENT = 'image_event';
    const NOM_EVENT = 'nom_event';
    const PRIX_EVENT = 'prix_event';
    const CREATED_BY_EVENT = 'created_by_event';
    const ID_STATUT_EVENT = 'id_statut_event';
    //fk to table VILLES
    const ID_VILLE = 'id_ville';
//    FK to table tranches_age
    const ID_TRANCHE_AGE = 'id_tranche_age';
    //    FK to table prestataires
    const ID_PRESTA_EVENT = 'id_presta_event';
    //FK id_status
    conSt ID_STATUT = 'id_statut';
    conSt COMMENTAIRE = 'commentaire';
    conSt MODIF = 'modif_statut';
    const CREATED_EVENT = 'created_event';

    /*     * ***********************************
      READ REQUESTS
     * ************************************ */

    public function getEvents($idVille) {
        $this->db->where(self::ID_VILLE, $idVille)
                ->where('date_event >= CURRENT_DATE()')
                ->select()
                ->from(self::TABLE_EVENT);

        return $data = $this->db->get()->result();
    }

    public function getAllEvents() {
        $this->db->select()
                ->from(self::TABLE_EVENT);

        return $data = $this->db->get()->result();
    }

    public function getEventsCreatedBy($userId) {

        $this->db->where(self::CREATED_BY_EVENT, $userId)
                ->select()
                ->from(self::TABLE_EVENT);

        $res = $this->db->get()->result();

        if ($res != null) {
            return $res;
        } else {
            return FALSE;
        }
    }

    public function getEventDetailsById($id) {

        $this->db->where(self::ID_EVENT, $id)
                ->select()
                ->from(self::TABLE_EVENT);
        return $this->db->get()->row();
    }

    public function getEventByUserId($id) {

        $query = $this->db->where(self::ID_USER, $id)
                ->select()
                ->from(self::TABLE_RESA);

        $res = $query->get()->result();

        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    public function getNbResaByEventId($eventId) {

		 

        $query = $this->db->query("SELECT COUNT(*) AS numrows FROM " . self::TABLE_RESA . "
               WHERE " . self::ID_EVENT . "='$eventId'.AND ". self::STATUS_RESA."=4");

		


        if ($query->num_rows() == 0)
            return '0';

        $row = $query->row();
        return $row->numrows;
    }

    //to record a new event we first must display all prestataires in the add event view
    public function getAllFromPresta() {


        $query = $this->db->select()
                ->from(self::TABLE_PRESTA);

        $res = $query->get()->result();

        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    //to record a new event we first must display all tranches d'âage in the add event view
    public function getAllFromTAge() {


        $query = $this->db->select()
                ->from(self::TABLE_TAGE);

        $res = $query->get()->result();

        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    public function getCommentsByEventId($id) {

        $this->db->where(self::ID_EVENT, $id)
                ->select()
                ->from(self::TABLE_COMMENTAIRES_EVENT);

        return $this->db->get()->result();
    }

    /*     * ************************************
      INSERT REQUESTS
     * ************************************ */

    public function insertCommentsToEvent($id, $commentaire) {

        $data = array(
            self::ID_EVENT => $id,
            self::COMMENTAIRE => $commentaire
        );

        $this->db->insert(self::TABLE_COMMENTAIRES_EVENT, $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //paypal
    public function insertTransaction($data) {
        $insert = $this->db->insert(self::DATE_EVENT, $data);
        return $insert ? true : false;
    }

    public function insertNewReservation($idUser, $idEvent) {

        $date = date('Y-m-d H:i:s');
        $ref = 'RD-' . $date;

        $data = [
            self::ID_USER => $idUser,
            self::ID_EVENT => $idEvent,
            self::DATE_RESA => $date,
            self::REF_RESA => $ref
        ];

        $this->db->insert(self::TABLE_RESA, $data);
        $idUser = $this->session('id_user');


        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            false;
        }
    }

    public function insertNewEvent($nom, $date, $heure, $idVille, $nbPlaces, $idTage, $presta, $prix, $idUser, $isAmbassadeur) {

        if ($presta != "à définir plus tard") {
            $status = 1;
        } else {
            $status = 5;
        }
        $data = [
            self::NOM_EVENT => $nom,
            self::DATE_EVENT => $date,
            self::HEURE_EVENT => $heure,
            self::ID_VILLE => $idVille,
            self::NB_PLACE_EVENT => $nbPlaces,
            self::ID_TRANCHE_AGE => $idTage,
            self::ID_PRESTA_EVENT => $presta,
            self::PRIX_EVENT => $prix,
            self::ID_STATUT_EVENT => $status,
            self::CREATED_BY_EVENT => $idUser,
            self::CREATED_EVENT => date('Y-m-d H:i:s')
        ];

        $this->db->insert(self::TABLE_EVENT, $data);

        $insertedId = $this->db->insert_id();

        if ($insertedId != null) {
            
            if ($isAmbassadeur) {
                $res = $this->AddAmbassyToEvent($idUser, $insertedId);
                if ($res) {

                    return $insertedId;
                } else {
                    return FALSE;
                }
            }else{
                return $insertedId;
            }
        } else {
            return FALSE;
        }
    }

    /*     * ************************************
      UPDATE REQUESTS
     * ************************************ */

    public function addMediaToEvent($idEvent, $idMedia) {
        // Update

        $idMed = [self::IMAGE_EVENT => $idMedia];
        $this->db->set($idMed);
        $this->db->where(self::ID_EVENT, $idEvent);
        $this->db->update(self::TABLE_EVENT);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updatePlacesPrix($places, $prix, $idEvent) {


        $data = array(
            self::NB_PLACE_EVENT => $places,
            self::PRIX_EVENT => $prix
        );

        $this->db->where(self::ID_EVENT, $idEvent)
                ->update(self::TABLE_EVENT, $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateEventStatus($idStatut, $idEvent) {


        $data = array(
            self::ID_STATUT_EVENT => $idStatut,
        );

        $this->db->set($data)
                ->where(self::ID_EVENT, $idEvent)
                ->update(self::TABLE_EVENT);

        if ($this->db->affected_rows() > 0) {

            $this->db->set(self::ID_STATUT, $idStatut)
                    ->set('modif_statut', date('Y-m-d H:i:s'))
                    ->set(self::ID_EVENT, $idEvent)
                    ->insert(self::TABLE_STATUT_EVENT);
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    public function updatePrestaEvent($idEvent, $idPresta) {

        $this->db->set(self::ID_PRESTA_EVENT, $idPresta)
                ->set(self::ID_STATUT_EVENT, 1)
                ->where(self::ID_EVENT, $idEvent)
                ->update(self::TABLE_EVENT);

        if ($this->db->affected_rows() > 0) {

            $this->db->set(self::ID_STATUT, 1)
                    ->set('modif_statut', date('Y-m-d H:i:s'))
                    ->set(self::ID_EVENT, $idEvent)
                    ->insert(self::TABLE_STATUT_EVENT);
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /*     * ************************************
      DELETE REQUESTS
     * ************************************ */

    public function deleteEvent($id) {

        $date = date('Y-m-d');
        //count resa where id event = id. if More than 0, you can not cancel an event.
        $nbResa = $this->getNbResaByEventId($id);


        if ($nbResa == 0) {

            $this->db->set(self::ID_STATUT, 2)
                    ->set('modif_statut', date('Y-m-d H:i:s'))
                    ->set(self::ID_EVENT, $id)
                    ->insert(self::TABLE_STATUT_EVENT);

            if ($this->db->affected_rows() > 0) {

                $this->db->set(self::ID_STATUT_EVENT, 2)
                        ->where(self::ID_EVENT, $id)
                        ->update(self::TABLE_EVENT);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    public function AddAmbassyToEvent($idUser, $idEvent) {

        $this->db->set(self::ID_USER, $idUser)
                ->set(self::ID_EVENT, $idEvent)
                ->insert(self::TABLE_AMBASSADEUR_EVENT);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAmbDetailsFromIdEvent($idEvent) {
        
        $query = $this->db->query("select * from users as u join ambassadeurs_event as ae on u.id_user = ae.id_user where ae.id_event=$idEvent");
        
        return $query->result();
        
    }
    public function getAllEventFromAmbId($userId) {
        
        $query = $this->db->query("select * from events join ambassadeurs_event on events.id_event = ambassadeurs_event.id_event where ambassadeurs_event.id_user = $userId");

        return $res = $query->result();

    }
    
    public function deleteAmbFromEvent($eventId) {
        
        $this->db->where(self::ID_EVENT, $eventId)
                ->delete(self::TABLE_AMBASSADEUR_EVENT);
        
        if($this->db->affected_rows()>0){
            
            return TRUE;
        }else{
            return FALSE; 
        }
                
        
    }
    public function getLastStatusByEvent($idEvent) {

        $res = $this->db->limit(1)
                ->select()
                ->order_by(self::MODIF, 'desc')
                ->from(self::TABLE_STATUT_EVENT);

        var_dump($res);
//        if ($res) {
//            
//            $this->load->model('Statuts_model','statusModel');
//            $result = $this->statusModel->getStatusById($res->id_status);
//            
//            var_dump($result['statut']);
//            
//            
//             $res->id_status;
//        } else {
//            return FALSE;
//        }
    }

    //UPDATE
}
