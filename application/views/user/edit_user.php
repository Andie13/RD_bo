<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($connected) {
    
} else {
    echo 'non connecté';
}
?>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper" style=''>
        <!-- Horizontal - start -->
        <div class="row">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class="page-title">

                    <div class="pull-left">
                        <h1 class="title">Détails Utilisateur</h1>                            </div>

                    <div class="pull-right hidden-xs">
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard_controller"?>><i class="fa fa-home"></i>Home</a>
                            </li>
                          <li>
                            <a href="<?php echo base_url(); ?>login_controller/logout"><i class="fa fa-lock"></i>Déconnexion</a>
                        </li>

                            <li class="active">
                                <strong>Edit Playlist</strong>
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
                            <i class="fa fa-user"></i>l'utilisateur
                        </a>
                    </li>
					<?php 
			
			if($permission ==4){
					echo '<li>
                        <a href="#details" data-toggle="tab">
                            <i class="fa fa-edit"></i> Modifier rôle 
                        </a>
                    </li>    ';
}?>
                                
                    <li>
                        <a href="#location" data-toggle="tab">
                            <i class="fa fa-map-marker"></i>secteur
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
                            <img src="<?php echo base_url() ?>uploads/prof.jpg" class="img-responsive">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="field-1">Nom de l'utilisateur</label>
                            <span class="desc"></span>
                            <div class="controls">
                                <h2><?php echo $user->nom_user; ?></h2> <br>
                                <h2><?php echo $user->prenom_user; ?></h2> <br>
                                <h2><?php echo $perm ?> </h2> <br>

                                <!--secteur géographique-->
<!--                                <h2>A <?php echo $ville->nom_commune; ?></h2> <br>-->


                                <h2><?php echo $user->tel_user ?> </h2> <br>

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
                                <?php
                                if ($resas != "") {
                                    echo '<ul><li>';
                                    foreach ($resas as $r) {

                                        echo $r->ref_resa.' - '.$r->date_resa.' - Confirmé';
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
                    <form method="POST" action="<?php echo base_url(); ?>Users_controller/updateUserRole">
                        <div class="form-group">
                            <h2 class="form-label">Statut de l'utilisateur</h2>
                            <span class="desc"></span>
                            <div class="controls">
                                <input style="visibility: hidden" name="id_user" value="<?php echo $user->id_user; ?>">


                                <select name="role">
                                    <option value="<?php echo $user->id_perm_user; ?>" checked><?php echo $perm ?></option>
                                    <?php
                                    foreach ($perms as $p) {
                                        echo '<option value="' . $p->id_perm . '">' . $p->permission . '</option>';
                                    }
                                    ?>
                                </select>
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
                <div class="tab-pane fade in" id="location">

                    <div class="form-group">
                        <h2>Comming soon :-)</h2>

                    </div>
                </div>


                <div class="tab-pane fade in" id="comments">
                    <form method="POST" action="<?php echo base_url(); ?>Users_controller/addCommentToUser">
                        <div class="form-group">
                            <label class="form-label" for="field-6">Commentaires</label>
                            <span class="desc">Entrez un commentaire ici"</span>
                            <input style="visibility: hidden" name="id_user" value="<?php echo $user->id_user; ?>">

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














