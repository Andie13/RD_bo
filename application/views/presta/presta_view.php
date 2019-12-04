<body>
    <!-- START CONTENT -->
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

                            <li class="active">
                                <strong>Tous les prestataires</strong>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Tous les prestataires</h2>

                    </header>

                    <div class="content-body">   



                        <table id="example" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Ville</th>
                                    <th>Cp</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>


                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Ville</th>
                                    <th>Cp</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                if ($prestas > 0) {
                                    foreach ($prestas as $row) {

                                        $villeModel = new Villes_model();
                                        $ville = $villeModel->getNomVilleFromId($row->id_ville_presta);



                                        echo '<tr>';
                                        echo '<td>';
                                        echo $row->nom_presta;
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row->adresse_presta;
                                        echo '</td>';
                                        echo '<td>';
                                        echo $ville->nom_commune;
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row->cp_presta;
                                        echo '</td>';

                                        echo '<td>';
                                        echo '<p><a  href="'. base_url().'Presta_controller/toEditPresta?id_presta=' . $row->id_presta . '">Visualiser</a></p>';


                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- ********************************************** -->
                        <button  class="btn btn-val btn-icon right15" style="background-color:#99ccff">  
                            <i class="fa fa-plus " style="color:white"></i>
                            <a style="color:white" href="<?php echo base_url() ?>Presta_controller/toAddPresta">
                                Ajouter une soirée
                            </a>
                        </button>

                    </div>
            </div>
        </section>

    </section>
    <script>
$('#example').dataTable( {
    "aoColumnDefs": [
      { "bSearchable": true, "aTargets": [ 0 ] },
      { "bSearchable": false, "aTargets": [ 1] },
      { "bSearchable": false, "aTargets": [ 2] },
      { "bSearchable": false, "aTargets": [ 3] }
    ] } );
    </script>


</body>
