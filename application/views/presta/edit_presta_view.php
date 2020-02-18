<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper" style=''>
        <!-- Horizontal - start -->
        <div class="row">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class="page-title">

                    <div class="pull-left">
                        <h1 class="title">Détails du Prestataire</h1>                            </div>

                    <div class="pull-right hidden-xs">
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard_controller""><i class="fa fa-home"></i>Home</a>
                            </li>
                         
                            <li class="active">
                                <strong>Edit Playlist</strong>
                            </li>
											   <li>
                                <a href="<?php echo base_url(); ?>login_controller/logout"><i class="fa fa-lock"></i>Déconnexion</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <ul class="nav nav-tabs primary">
                    <li class="active">
                        <a href="#infos" data-toggle="tab">
                            <i class="fa fa-user"></i>Le Prestataire
                        </a>
                    </li>
                    <li>
                        <a href="#details" data-toggle="tab">
                            <i class="fa fa-edit"></i> Modifier Presta
                        </a>
                    </li>                

                    <li>
                        <a href="#comments" data-toggle="tab">
                            <i class="fa fa-pencil"></i>Commentaires
                        </a>
                    </li>

                </ul>
            </div>

            <div class="tab-content primary">
                <?php
                if ($this->session->flashdata('err')) {
                    ?>

                    <div class="display_error">
                        <p> <?php echo $this->session->flashdata('err'); ?></p>
                    </div>


                <?php } elseif ($this->session->flashdata('success')) { ?>

                    <div class="display_success">
                        <p> <?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                <?php } ?>

                <div class="tab-pane fade in active" id="infos">
                    <div class="uprofile-name">

                        <h2>Détails de l'utilisateur: </h2>
                        <div class="uprofile-image">

                            <?php
                            if ($mediasPresta != '') {

                                foreach ($mediasPresta as $m) {
                                    echo '<img src="' . $m->path_media . '/' . $m->nom_media . '" class="img-responsive">';
                                }
                            }
                            ?>


                        </div>
                        <div class="form-group">
                            <label class="form-label" for="field-1">Nom du Prestaraire</label>
                            <span class="desc"></span>
                            <div class="controls">
                                <h2><?php echo $presta->nom_presta; ?></h2> <br>
                                <h2><?php echo $ville->nom_commune; ?></h2> <br>




                                <h2>Contact : <?php echo $presta->contact_presta ?> </h2> <br>
                                <h2>Tel : <?php echo $presta->tel_presta ?> </h2> <br>

                                <?php
                                if ($comments != NULL) {
                                   
                                    echo '<ul><li>';
                                    foreach ($comments as $c) {

                                        echo $c->commentaire;
                                    }
                                    echo '</ul></li>';
                                } else {
                                    echo 'Il n\'y a pas encore de commentaire';
                                }
                                ?>


                            </div>


                        </div>

                    </div>         

                </div>
                <div class="tab-pane fade in" id="details">

                    <hr>
                    <form method="POST" action="<?php echo base_url(); ?>Presta_controller/updateDetails">
                        <input style="visibility: hidden" name="id_presta" value="<?php echo $presta->id_presta; ?>">

                        <div class="form-group">
                            <label class="form-label" for="field-1">Contact</label>
                            <span class="desc">e.g. "Martin"</span>
                            <div class="controls">
                                <input type="text" name="contact"  id="field-1"  >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="field-1">Téléphone</label>
                            <span class="desc">e.g. 0600000000 ou 06-00-00-00-00"</span>
                            <div class="controls">
                                <input type="text" id="tel" name="tel_contact" id="phone"
                                       pattern="([0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2})|([0-9]{10})" placeholder="Votre tel..." >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-icon right15 btn-val">
                            <i class="fa a fa-plus-square-o" style="color:white"></i>
                            <a class="contact" style="color:white">
                                Sauvegarder
                            </a>
                        </button>
                    </form>
                </div>



                <div class="tab-pane fade in" id="comments">
                    <form method="POST" action="<?php echo base_url(); ?>Presta_controller/addCommentToPresta">
                        <div class="form-group">
                            <label class="form-label" for="field-6">Commentaires</label>
                            <span class="desc">Entrez un commentaire ici"</span>
                            <input style="visibility: hidden" name="id_presta" value="<?php echo $presta->id_presta; ?>">

                            <div class="controls">
                                <textarea  name="comment" class="form-control autogrow" cols="5" id="field-6">
                                    
                                </textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-icon right15 btn-val">
                            <i class="fa a fa-plus-square-o" style="color:white"></i>
                            <a style="color:white">
                                Sauvegarder
                            </a>
                        </button> 
                    </form>
                </div>


            </div>
        </div>
    </section>
</section>·

 <script type="text/javascript">
        $(document).ready(function () {


            $('.contact').on('click', function () {
                return confirm('Etes-vous sûre de vouloir changer le contact du prestataire? ' + '\n' + 'L\'ancien contact sera définitivement écrasé..');

            });



        });

    </script>










