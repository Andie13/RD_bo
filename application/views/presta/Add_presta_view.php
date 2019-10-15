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
                            <a href="<?php echo base_url(); ?>Presta_controller">Prestataires</a>
                        </li>

                        <li class="active">
                            <strong>Ajout d'un prestataire</strong>
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
                            <form action="<?php echo base_url();?>Presta_controller/addPresta" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Name</label>
                                    <span class="desc">e.g. "Café de la renaissance"</span>
                                    <div class="controls">
                                        <input type="text" name="nom" class="form-control" id="field-1" required >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="field-1">Adresse</label>
                                    <span class="desc">e.g. "rue jaune"</span>
                                    <div class="controls">
                                        <input type="tel" name="adresse" class="form-control" id="field-1" placeholder="30" required>
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
                                    <label class="form-label" for="field-1">CP</label>
                                    <span class="desc">e.g. "13100"</span>
                                    <div class="controls">
                                        <input type="text" name="cp" class="form-control" id="field-1" placeholder="13100" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Contact</label>
                                    <span class="desc">e.g. "Café de la renaissance"</span>
                                    <div class="controls">
                                        <input type="text" name="contact" class="form-control" id="field-1" required >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Téléphone</label>
                                    <span class="desc">e.g. 0600000000 ou 06-00-00-00-00"</span>
                                    <div class="controls">
                                        <input type="text" id="tel" name="tel" id="phone"
                                               pattern="([0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2})|([0-9]{10})" placeholder="Votre tel..." >
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="form-label" for="field-1">Image</label>
                                    <span class="desc">e.g. "Images de l'évènement"</span>
                                    <div class="controls">
                                        <label for="file"><span>Nom du fichier:</span></label>
                                        <br>
                                        <br>
                                        <input type="file" name="files[]" id="file" multiple/>                                       
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
                            return obj.nom_commune + '__' + obj.id_ville;
                        });

                        response(resp);
                    }
                });
            },
            minLength: 3,

        });



    });


</script>   