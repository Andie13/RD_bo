<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (isset($userId)) {
    
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
                        <h1 class="title">Détail événement</h1>                            </div>

                    <div class="pull-right hidden-xs">
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.html"><i class="fa fa-home"></i>Home</a>
                            </li>
                            <li>
                                <a href="mus-playlists.html">Playlists</a>
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
                            <i class="fa fa-calendar"></i>l'événement
                        </a>
                    </li>
                    <li>
                        <a href="#details" data-toggle="tab">
                            <i class="fa fa-edit"></i> Modifier détails 
                        </a>
                    </li>
                    <li>
                        <a href="#medias" data-toggle="tab">
                            <i class="fa fa-camera-retro"></i> modifier Médias
                        </a>
                    </li>
                    <li>
                        <a href="#presta" data-toggle="tab">
                            <i class="fa fa-glass"></i> modifier Prestataires
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

                        <h2>Détails de la soirée: </h2>
                        <div class="uprofile-image">
                            <img src="<?php echo base_url() ?>uploads/event.jpg" class="img-responsive">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="field-1">Nom de l'évènement</label>
                            <span class="desc"></span>
                            <div class="controls">
                                <h2><?php echo $nom; ?></h2> <br>
                                <h2>A <?php echo $ville->nom_commune; ?></h2> <br>
                                <h2><?php echo date_format(new DateTime($date), "d m Y") ?> </h2> <br>
                                <h2><?php
                                    echo date_format(new DateTime($heure), "H")
                                    . ' h ' . date_format(new DateTime($heure), 'i')
                                    ?> </h2> <br>
                                <h2><?php echo $statut ?> </h2> <br>

                            </div>

                            <?php
                            if ($presta != "") {

                                echo '<h2> Lieux: ' . $presta->nom_presta . '</h2><br>';
                                echo '<h2> Adresse: ' . $presta->adresse_presta . '</h2><br>';
                                echo '<div id="map" style="height:50%;width:50%;margin:auto;"></div>';
                            }
                            echo '<br>';
                            echo '<br>';
                            if (!$commentaires == null) {
                                echo '<h2>Liste des commentaires postés pour cet événement:</h2';

                                foreach ($commentaires as $comm) {
                                    echo '<ul><li>';
                                    echo $comm->commentaire;
                                    echo '</li></ul>';
                                }
                            } else {
                                echo 'Aucun commentaire enregistré à ce jour.';
                            }
                            ?>

                        </div>

                    </div>         

                </div>
                <div class="tab-pane fade in" id="details">
                    <form method="POST" action="<?php echo base_url(); ?>events/Update_event_controller/changeEventPriceNBPlaces">
                        <input style="visibility: hidden" name="id_event"value="<?php echo $event->id_event; ?>">
                        <h2>Prix et Nombre de places</h2>
                        <div class="form-group">
                            <label class="form-label" for="field-1">Nombre de places :</label>
                            <span class="desc"></span>
                            <div class="controls">
                                <input type="number" name="places" value="<?php echo $places ?>" class="form-control" id="field-1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="field-1">Prix entrée</label>
                            <span class="desc"></span>
                            <div class="controls">
                                <input type="text" name="prix" value="<?php echo $prix ?>" class="form-control" id="field-1">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-icon right15 btn-val">
                            <i class="fa a fa-plus-square-o" style="color:white"></i>
                            <a style="color:white">
                                Sauvegarder
                            </a>
                        </button>

                    </form>
                    <hr>
                    <form method="POST" action="<?php echo base_url(); ?>events/update_event_controller/changeEventStatus">
                        <div class="form-group">
                            <h2 class="form-label"">Statut de l'évènement</h2>
                            <span class="desc"></span>
                            <div class="controls">
                                <input style="visibility: hidden" name="id_event" value="<?php echo $event->id_event; ?>">


                                <select name="statut">
                                    <option value="<?php echo $event->id_statut_event; ?>" checked><?php echo $statut ?></option>
                                    <?php
                                    foreach ($statuts as $st) {
                                        echo '<option value="' . $st->id_statut . '">' . $st->statut . '</option>';
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
                <div class="tab-pane fade in" id="medias">

                    <div class="form-group">
                        <h2 class="form-label" for="field-1">Modifier l'image de l'évènement:</h2>
                        <span class="desc"></span>
                        <?php
                        if ($media != null) {
                            $path = base_url() . 'uploads/' . $media->nom_media;
                            ?> 
                            <img class="img-responsive" src="<?php echo$path ?>" alt="" style="max-width:300px;">
                            <?php
                        } else {
                            echo ' aucune image séléctionnée.';
                        }
                        ?>
                        <br>
                        <div class="controls">
                            <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>events_controller/updateMedia">
                                <input type="file" name="media" class="form-control" id="field-5">
                                <input style="visibility: hidden" name="id_event" value="<?php echo $event->id_event; ?>">

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
                <div class="tab-pane fade in" id="presta">
                    <h2>Changer de prestataire</h2>
                    <div class="form-group">
                        <?php
                        if ($presta != "") {

                            echo '<h2>Actuellement: ' . $presta->nom_presta . '</h2><br>';
                        }
                        ?>
                        <form method="POST" action="<?php echo base_url(); ?>events/update_event_controller/changePrestaEvent">
                            <label class="form-label" for="field-5">Ajoutez ou modifiez le prestataire: </label>
                            <span class="desc"></span>
                            <input style="visibility: hidden" name="id_event" value="<?php echo $event->id_event; ?>">

                            <select class="form-control" name="presta">
                                <option value="<?php echo!empty($presta) ? $event->id_presta_event : ''; ?>" checked> <?php echo!empty($presta) ? $presta->nom_presta : ''; ?></option>
                                <?php
                                foreach ($prestasList as $p) {
                                    echo '<option value="' . $p->id_presta . '">' . $p->nom_presta . '</option>';
                                }
                                ?>

                            </select>
                            <button type="submit" class="btn btn-primary btn-icon right15 btn-val">
                                <i class="fa a fa-plus-square-o" style="color:white"></i>
                                <a style="color:white">
                                    Sauvegarder
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade in" id="comments">
                    <form method="POST" action="<?php echo base_url(); ?>events/update_event_controller/addComment">
                        <div class="form-group">
                            <label class="form-label" for="field-6">Commentaires</label>
                            <span class="desc">Entrez un commentaire ici"</span>
                            <input style="visibility: hidden" name="id_event" value="<?php echo $event->id_event; ?>">

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1SXVeFzbltDLAVktP4baPf1CeBSXcjwM"></script>
<script>
    // In this example, we center the map, and add a marker, using a LatLng object
    // literal instead of a google.maps.LatLng object. LatLng object literals are
    // a convenient way to add a LatLng coordinate and, in most cases, can be used
    // in place of a google.maps.LatLng object.

    var lat = <?php echo $presta->latitude ?>;
    var lng = <?php echo $presta->longitude ?>;
    var map;
    function initialize() {
        var mapOptions = {
            zoom: 12,
            center: {lat: lat, lng: lng}
        };
        map = new google.maps.Map(document.getElementById('map'),
                mapOptions);

        var marker = new google.maps.Marker({
            // The below line is equivalent to writing:
            // position: new google.maps.LatLng(-34.397, 150.644)
            position: {lat: lat, lng: lng},
            map: map
        });

        // You can use a LatLng literal in place of a google.maps.LatLng object when
        // creating the Marker object. Once the Marker object is instantiated, its
        // position will be available as a google.maps.LatLng object. In this case,
        // we retrieve the marker's position using the
        // google.maps.LatLng.getPosition() method.
        var infowindow = new google.maps.InfoWindow({
            content: '<p>Marker Location:' + marker.getPosition() + '</p>'
        });

        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>














