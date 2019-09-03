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

                            <table id="example" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>

                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Genre</th>
                                        <th>tranche d'âge</th>                                          
                                        <th>nombre résas</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>

                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Genre</th>
                                        <th>tranche d'âge</th>                                          
                                        <th>Nombre résa</th>
                                        <th>Action</th>


                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    if ($users > 0) {
                                        foreach ($users as $row) {



                                            echo '<tr>';
                                            echo '<td>';
                                            echo $row->nom_user;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $row->prenom_user;
                                            echo '</td>';
                                            echo '<td>';
                                            echo 'homme';
                                            echo '</td>';
                                            echo '<td>';
                                            echo '18';
                                            echo '</td>';
                                            echo '<td>';
                                            echo '25';
                                            echo '</td>';

                                            echo '<td>';
                                            echo '<p><a>Visualiser</a></p>';

                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- ********************************************** -->

                        </div>
                    </div>
            </div>





        </section>

    </section>
    <script>

    </script>


</body>