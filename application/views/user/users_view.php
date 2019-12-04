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
                        <h2 class="title pull-left">Tous mes utilisateurs</h2>

                    </header>

                    <div class="content-body">   
                        <div class="row">
                            <div id="example-1_wrapper" class="dataTables_wrapper form-inline">

                                <table class="table table-striped dt-responsive display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="example-1_info" style="width: 100%;">
                                    <thead>
                                        <tr>

                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Genre</th>
                                            <th>Âge</th>                                          
                                            <th>nombre résas</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>

                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Genre</th>
                                            <th>Âge</th>                                          
                                            <th>Nombre résa</th>
                                            <th>Action</th>


                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($users > 0) {
                                            foreach ($users as $row) {

                                                $age = (time() - strtotime($row->anniv_user)) / 3600 / 24 / 365;

                                                if ($row->genre_user == 1) {
                                                    $genre = "Femme";
                                                } else {
                                                    $genre = "Homme";
                                                }

                                                $userModel = new Users_model();
                                                $resas = $userModel->getResasByUserId($row->id_user);



                                                echo '<tr>';
                                                echo '<td>';
                                                echo $row->nom_user;
                                                echo '</td>';
                                                echo '<td>';
                                                echo $row->prenom_user;
                                                echo '</td>';
                                                echo '<td>';
                                                echo $genre;
                                                echo '</td>';
                                                echo '<td>';
                                                echo (int) $age;
                                                echo '</td>';
                                                echo '<td>';
                                                echo count($resas);
                                                echo '</td>';

                                                echo '<td>';
                                                echo '<p><a href="' . base_url() . 'Users_controller/toEditUser?id_user=' . $row->id_user . '">Visualiser</a></p>';

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
                                    <a style="color:white" href="<?php echo base_url() ?>Users_controller/toAddUser">
                                        Ajouter un utilisateur
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
            </div>





        </section>

    </section>
    <script>


    </script>


</body>
