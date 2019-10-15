
<div class='page-topbar '>
    <div class='logo-area'>

    </div>
    <div class='quick-area'>
        <div class='pull-left'>
            <ul class="info-menu left-links list-inline list-unstyled">
                <li class="sidebar-toggle-wrap">
                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>



            </ul>
        </div>		
        <div class='pull-right'>
            <ul class="info-menu right-links list-inline list-unstyled">
                <li class="profile">
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <img src="<?php echo base_url() ?>assets/images/prof.jpg" alt="user-image" class="img-circle img-inline">
                        <span>Nanou <i class="fa fa-angle-down"></i></span>
                    </a>

            </ul>			
        </div>		
    </div>

</div>
<!-- END TOPBAR -->
<!-- START CONTAINER -->
<div class="page-container row-fluid">

    <!-- SIDEBAR - START -->
    <div class="page-sidebar ">

        <!-- MAIN MENU - START -->
        <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

            <!-- USER INFO - START -->
            <div class="profile-info row">

                <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                    <a href="ui-profile.html">
                        <img src="<?php echo base_url() ?>assets/images/prof.jpg" class="img-responsive img-circle">
                    </a>
                </div>

                <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                    <h3>
                        <a href="ui-profile.html">Nanou</a>

                        <!-- Available statuses: online, idle, busy, away and offline -->
                        <span class="profile-status online"></span>
                    </h3>

                    <?php if($this->session->permission == 2){
                        $role = 'Ambassadeur';
                    }elseif ($this->session->permission == 1) {
                        $role = 'Administrateur';
                        
                    }
?>
                    <p class="profile-title"><?php echo $role;?></p>

                </div>

            </div>
            <!-- USER INFO - END -->

            <ul class='wraplist'>	
                <li class=""> 
                    <a href="<?php echo base_url() ?>Dashboard_controller">
                        <i class="fa fa-calendar"></i>
                        <span class="title">Toutes les soirées</span>
                    </a>
                </li>
                <li class=""> 
                    <a href="<?php echo base_url() ?>Events_controller">
                        <i class="fa fa-edit"></i>
                        <span class="title">Ajouter une soirée</span>
                    </a>
                </li>
                
                <?php if ($this->session->permission != 2) { ?>
                    <li class=""> 
                        <a href="<?php echo base_url() ?>Users_controller">
                            <i class="fa fa-users"></i>
                            <span class="title">Les Utilisateurs</span>
                        </a>
                    </li>
                <?php  }
                ?>


                <li class=""> 
                    <a href="<?php echo base_url() ?>Presta_controller">
                        <i class="fa fa-glass"></i>
                        <span class="title">Les prestataires</span>
                    </a>
                </li>
                <li class=""> 
                    <a href="<?php echo base_url() ?>Presta_controller/toAddPresta">
                        <i class="fa fa-edit"></i>
                        <span class="title">Ajouter un Prestataire</span>
                    </a>
                </li>
                <li class=""> 
                    <a href="<?php echo base_url(); ?>login_controller/logout">
                        <i class="fa fa-lock"></i>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
        </div>
        <!-- MAIN MENU - END -->

    </div>


