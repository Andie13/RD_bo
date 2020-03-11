<section id="main-content">
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Soirées Real Dating</h1>                           
                </div>

                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <a href="add_resa_to_event.php"></a>
                        <li>
                            <a href="<?php echo base_url(); ?>login_controller/logout"><i class="fa fa-lock"></i>Déconnexion</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Dashboard_controller">Toutes les soirées</a>
                        </li>


                    </ol>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">Ajouter une Réservation</h2>
                </header>
                <div class="content-body">   
                    <div class="row">
                        <div class="col-md-8 col-sm-9 col-xs-10">
                            <h2><?php echo $event->nom_event ?></h2>
                            <h2><?php echo $event->date_event ?></h2>
                            <h2><?php echo $event->heure_event ?></h2>
                            <h2><?php echo $ville->nom_commune ?></h2>

                            <form action="<?php echo base_url()?>events/Update_event_controller/addResa" method="POST" >
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Sélectionner un client:</label>
                                    <input type="hidden" name="eventId" value="<?php echo $event->id_event?>"/>
                                    <input type="hidden" name="prix" value="<?php echo $event->prix_event?>"/>
                                    <div class="controls">
                                        <select name="userId">
                                            <?php
                                            foreach ($users as $u) {
                                                echo '<option  value="' . $u->id_user . '">' . strtoupper($u->nom_user) . ' ' . $u->prenom_user . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Sélectionner un Moyen de paiement:</label>
                                    <div class="controls">
                                        <select name="typePay">
                                            <?php
                                            foreach ($typePayment as $tp) {
                                                echo '<option  value="' . $tp->id_type_paymt . '">' . strtoupper($tp->type_paymt) . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-1">Sélectionner une promo:</label>
                                    <div class="controls">
                                        <select name="promo">
                                            <?php
                                            foreach ($promo as $p) {
                                                echo '<option  value="' . $p->calcul_promo . '">' . $p->promo .  '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <button  type="submit" class="btn btn-val btn-icon right15" style="background-color:#99ccff">  
                                    <i class="fa fa-plus " style="color:white"></i>
                                    <a style="color:white" >
                                        Ajouter une reservation
                                    </a>
                                </button>

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

        $("#datedebut").datepicker({dateFormat: 'dd/mm/yy',
            changeMonth: true
            , changeYear: true
            , yearRange: '-1:+1'
        });



    });


</script>   
<script type="application/javascript"> 
    $(document).ready(function() { 
    $("#datedebut").datepicker({ dateFormat: 'dd/mm/yy', 
    changeMonth: true 
    , changeYear: true 
    , yearRange: '-1:+1' 
    }); 
</script>