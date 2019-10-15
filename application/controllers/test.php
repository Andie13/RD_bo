<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class test extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('test_view');
    }
    public function upload() {

   
        if (isset($_FILES['logo'])) {

//        //si pas d'erreur

            if ($_FILES['logo']['error'] == 0) {

                $temp = $_FILES['logo']['tmp_name'];
                // reset pic name in case two store insert images with same name
                $picNmae =  $_FILES['logo']['name'];


                //check format
                $type = $this->checkMediaType($picNmae);

              
                    $path = FCPATH . 'uploads';
//                  
                    move_uploaded_file($temp, "$path/$picNmae");

                    $imagePath = base_url() . 'uploads';
                    
//                    $mm = new MediaModel();
//                    $mm->create_media(1, $picNmae, $imagePath,$type);
               

               echo ' success';
//             
            } else {

                  echo ' eror';
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

    public function update_media_to_campaign(){
        
          $id_store = $_GET['id_store'];
          $id_camp = $_GET['id_camp'];
          
        if (isset($_FILES['image_store'])) {

//        //si pas d'erreur

            if ($_FILES['image_store']['error'] == 0) {

                $temp = $_FILES['image_store']['tmp_name'];
                // reset pic name in case two store insert images with same name
                $picNmae = $id_store . '-' . $_FILES['image_store']['name'];


                //check format
                $type = $this->checkMediaType($picNmae);

              
                    $path = FCPATH . 'uploads';
//                  
                    move_uploaded_file($temp, "$path/$picNmae");

                    $imagePath = base_url() . 'uploads';
                    $datas = array('succes' => 'true',
                        'id_store' => $id_store);


                    $this->session->set_flashdata($datas);
                    $mm = new MediaModel();
                    $inserted_id =$mm->create_media($_POST['id_store'], $picNmae, $imagePath,$type);
                    // insert new media 
                    
                  $cmm = new CampaignMediaModel();
                  $cmm->create_media($inserted_id, $id_camp, 5);
                 

               redirect("Store_controller/getStoreDetails?id=" . $id_store . "&success=true", 301);
//             
            } else {

                $this->session->set_userdata('Uploat_succes', FALSE);
                Header("Location: Store_controller/getStoreDetails?id=" . $id_store . "&success=false");
            }
        }
    }
}
