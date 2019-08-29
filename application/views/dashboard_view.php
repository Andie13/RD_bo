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
                                <strong>Toutes les soirées</strong>
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

                            <table  class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>

                                        <th>Nom</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Ville</th>                                          
                                        <th>Statut</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>

                                        <th>Nom</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Ville</th>                                          
                                        <th>Statut</th>
                                        <th>Action</th>


                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $eventModel = new Events_model();
                                    $villeModel = new Villes_model();

                                    $rows = $eventModel->getAllEvents();

                                    if ($rows > 0) {
                                        foreach ($rows as $row) {

                                            $ville = $villeModel->getNomVilleFromId($row->id_ville);


                                            echo '<tr>';
                                            echo '<td>';
                                            echo $row->nom_event;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $row->date_event;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $row->heure_event;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $ville->nom_commune;
                                            echo '</td>';
                                            echo '<td>';
                                            echo 'active';
                                            echo '</td>';

                                            echo '<td>';
                                            echo '<p><a>Visualiser</a></p>';
                                            echo '<p><a>Annuler</a></p>';

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
                                <a style="color:white" href="nouveau_rdv.php">
                                    Ajouter une soirée
                                </a>
                            </button>
                        </div>
                    </div>
            </div>





        </section>

    </section>
        <script>
            
        </script>


</body>