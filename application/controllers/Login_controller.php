<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    function __construct() {
        parent::__construct();


        $this->load->library('email');
    }

    public function index() {

        $this->load->view('layout/header');
        if ($this->session->userdata('is_connected') == NULL) {
            $this->load->view('login/login_view');
        } elseif ($this->session->userdata('is_connected') == FALSE) {
            $this->load->view('login/login');
        }
        if ($this->session->userdata('is_connected') == TRUE) {
            redirect('Dashboard_controller', 301);
        }
    }

    public function loginUser() {


        $email = $this->input->post('log');
        $pwd = $this->input->post('pwd');



        $md5pass = md5($pwd);


        $am = new Admin_model();

        $res = $am->get_admin($email, $md5pass);



        if (sizeof($res) == 1) {

            //set session


            $sessionDatas = array(
                'first_name' => $res->firstname_admin,
                'last_name' => $res->lastname_admin,
                'connected' => TRUE,
                'id_admin' => $res->id_admin
            );

            $this->session->set_userdata($sessionDatas);


            redirect('Dashboard_controller');
        } else {

            $this->session->set_flashdata('err', "identifiant ou mot de passe erroné.");
            redirect('login_controller');
        }
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

    public function resetPassword() {

        //check if email given exists
        $am = new Admin_model();
        $res = $am->count_user_by_email($_POST['log']);
        if ($res == false) {
            $this->session->set_flashdata('err', "Email inconnu");
            $this->load->view('login/login');
        } else {

            //generate password
            // $pass = $this->generatePassword(8);
            //test
            $pass = '12341234';
            //send email
            $this->email->from('fody.fady@gmail.com', 'Anne');
            $this->email->to($_POST['log']);

            $this->email->subject('Réinitialisation de mot de passe');
            $this->email->message("Bonjour,"
                    . "\n"
                    . "\n"
                    . "Veuillez trouver ci-dessous votre nouveau mot de passe" . "\n"
                    . "\n"
                    . "\n"
                    . $pass
                    . "\n"
                    . "\n"
                    . 'Codrialement,'
                    . "\n"
                    . "\n"
                    . 'l\'équipe Admin');

            $this->email->send();
            $email = $_POST['log'];


            $md5Pass = md5($pass);
            //update database with email
            $am->insert_new_password($email, $md5Pass);
            echo 'Done';
        }
    }

    public function logout() {

        $_SESSION['is_connected'] = FALSE;
        redirect('Login_controller', 301);
    }

}
