<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->load->view('layout/header');


        if ($this->session->connected) {


            $datas['userId'] = $this->session->userId;
            $datas['connected'] = $this->session->connected;

            //récupération des données à afficher dans la vue.
            $userModel = new Users_model();
            $users = $userModel->getAllUsers();



            if ($users) {
                $datas['users'] = $users;
            }


            $this->load->view('layout/sidebar');

            $this->load->view('user/Users_view', $datas);
        } else {
            $this->load->view('login/login_view');
        }
    }

    public function toEditUser() {

        $userId = $this->input->get("id_user");
        $this->load->view('layout/header');

        $userModel = new Users_model();
        $adminModel = new Admin_model();
        
        $eventMidel = new Events_model();
        
        
        $perms = $adminModel->getAllFromPermissions();

        $comments = $userModel->getCommentsFromUser($userId);

        $user = $userModel->getUserById($userId);

        switch ($user->id_perm_user) {
            case 1:
                $perm = 'Administrateur';
                break;
            case 2:
                $perm = 'Ambassadeur';
                break;
            default:
                $perm = 'Client';
                break;
        }
        
        $resas = $eventMidel->getEventByUserId($userId);
        
        
        if(count($resas)>0){
            $datas['resas'] = $resas;
            
        }else{
            $datas['reses'] = "";
        }

        if ($this->session->connected) {


            $datas['userId'] = $this->session->userId;
            $datas['connected'] = $this->session->connected;
            $datas['user'] = $user;
            $datas['perms'] = $perms;
            $datas['perm'] = $perm;
            $datas['comments'] = $comments;


            $this->load->view('layout/sidebar');

            $this->load->view('user/edit_user', $datas);
        } else {
            $this->load->view('login/login_view');
        }
    }

    public function addCommentToUser() {

        $idUser = $this->input->post('id_user');
        $comment = $this->input->post('comment');

        $userModel = new Users_model();
        $res = $userModel->insertUserComment($idUser, $comment);

        if ($res) {

            $this->session->set_flashdata('success', "Vous avez changé le rôle de l'utilisateur.");
            redirect("Users_controller/toEditUser?id_user=$idUser");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Users_controller/toEditUser?id_user=$idUser");
        }
    }

    public function updateUserRole() {

        $idUser = $this->input->post('id_user');
        $role = $this->input->post('role');

        $userModel = new Users_model();
        $res = $userModel->updateUserRole($idUser, $role);

        if ($res) {

            $this->session->set_flashdata('success', "Votre commentaire est bien enregistré");
            redirect("Users_controller/toEditUser?id_user=$idUser");
        } else {

            $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
            redirect("Users_controller/toEditUser?id_user=$idUser");
        }
    }

    public function toAddUser() {

        $this->load->view('layout/header');
        $adminModel = new Admin_model();
        $perms = $adminModel->getAllFromPermissions();

        $datas['perms'] = $perms;

        if ($this->session->connected) {


            $this->load->view('layout/sidebar');

            $this->load->view('user/add_user_view', $datas);
        } else {
            $this->load->view('login/login_view');
        }
    }

    public function addUser() {

        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $tel = $this->input->post('tel');
        $email = $this->input->post('email');
        $role = $this->input->post('role');

        $password = $this->generatePassword(8);

        $md6 = md5($password);

      

        $userModel = new Users_model();
        $isuserExist = $userModel->checkIfUserEvists($email);
        
        if ($isuserExist) {
            
             $this->session->set_flashdata('err', "L'utilisateur existe déjà. ");
             redirect("Users_controller");
        }else{
              $res = $userModel->registerUser($nom, $prenom, $email, $tel, $md6, $role);

            if ($res) {

                $this->sendEmailToNewUser($password, $email);

                $this->session->set_flashdata('success', "Le nouvel utilisateur a bien été enregistré.");
                redirect("Users_controller");
            } else {

                $this->session->set_flashdata('err', "Nous n'avons pu mettre à jour vos informations.");
                redirect("Users_controller");
            }
        }
         
      



        //envoi du mot de passe généré par email
    }

    public function generatePassword($_len) {

        $_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';            // small letters
        $_alphaCaps = strtoupper($_alphaSmall);                // CAPITAL LETTERS
        $_numerics = '1234567890';                            // numerics
        $_specialChars = '`~!@#$%^&*()-_=+]}[{;:,<.>/?\'"\|';   // Special Characters

        $_container = $_alphaSmall . $_alphaCaps . $_numerics . $_specialChars;   // Contains all characters
        $password = '';         // will contain the desired pass

        for ($i = 0; $i < $_len; $i++) {                                 // Loop till the length mentioned
            $_rand = rand(0, strlen($_container) - 1);                  // Get Randomized Length
            $password .= substr($_container, $_rand, 1);                // returns part of the string [ high tensile strength ;) ] 
        }

        return $password;       // Returns the generated Pass
    }

    public function sendEmailToNewUser($pass, $email) {

        $this->load->library('email');

        $this->email->from('andie.p@hotmail.fr', 'Site name');
        $this->email->to($email);
        $this->email->subject('Votre nouveau compte à été créé ! ');
        $this->email->message('Vous trouverez ci-joint votre nouveau mot de passe: </br> ' . $pass . '');
        $this->email->send();
    }

}
