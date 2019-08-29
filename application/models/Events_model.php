<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Events_model extends CI_Model {

    const TABLE_EVENT = 'events';
    const TABLE_PAYMENT = 'payments';
    const TABLE_RESA = 'resa';
    const ID_USER = 'id_user';
    const REF_RESA = 'ref_resa';
    const STATUS_RESA = 'status_resa';
    const DATE_RESA = 'date_resa';
    const ID_EVENT = 'id_event';
    const ID_VILLE = 'id_ville';
    const DATE_EVENT = 'date_event';
    const HEURE_EVENT = 'heure_event';
    const NB_PLACE_EVENT = 'nb_place_event';
    const ID_TRANCHE_AGE = 'id_tranche_age';
    const ID_PRESTA_EVENT = 'id_presta_event';
    const PRIX_EVENT = 'prix_event';
    const ID_IMAGE_EVENT = 'id_image_event';

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

    public function getEventDetailsById($id) {

        $this->db->where(self::ID_EVENT, $id)
                ->select()
                ->from(self::TABLE_EVENT);
        return $this->db->get()->row();
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
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            false;
        }
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
        
        $query = $this->db->query("SELECT COUNT(*) AS numrows FROM ".self::TABLE_RESA."
               WHERE ".self::ID_EVENT."='$eventId'");
        
        if ($query->num_rows() == 0)
            return '0';

        $row = $query->row();
        return $row->numrows;
    }

}
