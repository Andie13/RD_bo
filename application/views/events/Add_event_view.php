<section id="main-content">
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Soirées Real Dating</h1>                           
                </div>

                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>login_controller/logout"><i class="fa fa-lock"></i>Déconnexion</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Dashboard_controller">Toutes les soirées</a>
                        </li>

                        <li class="active">
                            <strong>Ajout d'une soirée</strong>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">Toutes mes soirées</h2>
                </header>
                <div class="content-body">   
                    <div class="row">
                        <div class="col-md-8 col-sm-9 col-xs-10">
                            <form action="Events_controller/addEvent" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Name</label>
                                    <span class="desc">e.g. "RealDating Party"</span>
                                    <div class="controls">
                                        <input type="text" name="nom" class="form-control" id="field-1" required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Ville</label>
                                    <span class="desc">e.g. "Aix-en-Provence"</span>
                                    <div class="controls custom-search-input">
                                        <input id="search" name="ville" type="text" class="autocomplete_input form-control" placeholder="ville" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Date & Heure</label>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <input type="datetime-local" name="date" value="15-08-2019" class="form-control datepicker col-md-4" data-format="DD-MM-YYYY" required>
                                        </div>
                                        <div class="col-xs-4" style='padding-left:0px;'>
                                            <input type="text" class="form-control timepicker col-md-4" name="heure" data-template="dropdown" data-show-seconds="true" data-default-time="09:45 PM" data-show-meridian="true" data-minute-step="5" data-second-step="5" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Nombre de places</label>
                                    <span class="desc">e.g. "30"</span>
                                    <div class="controls">
                                        <input type="number" name="nb_places" class="form-control" id="field-1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Ages concerné</label>
                                    <span class="desc"></span>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <ul class="list-unstyled">
                                                <?php
                                                if (isset($tages)) {

                                                    foreach ($tages as $tage) {
                                                        echo ' <li>
                                                    <input tabindex="5" type="checkbox" name="age" value="' . $tage->id_tranche . '" id="flat-checkbox-2" class="skin-flat-green" >
                                                    <label class="icheck-label form-label" for="flat-checkbox-2">' . $tage->categorie_tranche . '</label>
                                                </li>';
                                                    }
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-1">Prestataire</label>
                                        <span class="desc">e.g. "Lieux exacte de la soirée (facultatif)"</span>
                                        <div class="controls">
                                            <select class="form-control input-lg m-bot15" name="presta">
                                                <option> à définir plus tard </option>
                                                <?php
                                                if (isset($prestas)) {

                                                    foreach ($prestas as $presta) {
                                                        echo ' <option value="' . $presta->id_presta . '">' . $presta->nom_presta . ' - ' . $presta->cp_presta . '</option>';
                                                    }
                                                };
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-1">Image</label>
                                        <span class="desc">e.g. "Image de l'évènement"</span>
                                        <div class="controls">
                                            <label for="file"><span>Nom du fichier:</span></label>
                                            <br>
                                            <br>
                                            <input type="file" name="logo" id="file"/>                                       
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-1">Prix</label>
                                        <span class="desc">e.g. "10"</span>
                                        <div class="controls">
                                            <input type="number" name="prix" class="form-control" id="field-1" placeholder="30" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-1">Ambassadeurs</label>
                                        <span class="desc">e.g. "10"</span>
                                        <div class="scrollCheckbox">
                                         
                                            <input name="amb[]" type="checkbox" value="0" checked >à définir plus tard <br>
                                                <?php
                                                                                           
                                                if ($amb != '') {

                                                    foreach ($amb as $a) {
                                                        echo'<input name="amb[]" type="checkbox" value="' . $a->id_user . '">' . $a->prenom_user . ' ' . $a->nom_user . '<br>';
                                                    }
                                                }
                                                ?>

                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-icon btn-val btn-success">
                                                <i  style="color: white"class="fa fa-plus-square-o"></i>
                                                <a style="color: white">Ajouter</a>
                                            </button>
                                            <button  class="btn btn-icon btn-reject">
                                                <i  style="color: red"class="fa fa-trash-o"></i>
                                                <a style="color: red" href="<?php echo base_url() . 'Dashboard_controller' ?>">Annuler</a>
                                            </button>

                                        </div>
                                    </div>


                                </div> 
                            </form>
                        </div>

                    </div>
                </div>
        </div>
    </section>
</div>
</section>
</section>
<script>
    var BASE_URL = "<?php echo base_url(); ?>";

    $(document).ready(function () {
        $("#search").autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: BASE_URL + "ajax/Ajax_controller/search",

                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function (data) {

                        var resp = $.map(data, function (obj) {
                            return obj.nom_commune + '__' + obj.code_postal;
                        });

                        response(resp);
                    }
                });
            },
            minLength: 3,

        });
$("#datepicker").datepicker("option", "dateFormat", "dd-mm-yy" ).val();

    });


</script>   
