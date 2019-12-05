
<!-- END HEAD -->

<!-- BEGIN BODY -->
  <body class="bg">
        <?php
        if ($this->session->flashdata('err')) {
            ?>
            <div class = "alert alert-error">
                <?php echo $this->session->flashdata('err'); ?>
            </div>
        <?php } ?>

        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12">
                <h1 style="color: white">Connexion administrateur</h1>

               <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <body class="bg">
        <?php
        if ($this->session->flashdata('err')) {
            ?>
            <div class = "alert alert-error">
                <?php echo $this->session->flashdata('err'); ?>
            </div>
        <?php } ?>

        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12">
                <h1 style="color: white">Connexion administrateur</h1>

                <form  id="loginForm" action="<?php echo base_url() . 'Login_controller/loginUser' ?>" method="POST" enctype="multipart/form-data">


                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="col-lg-4">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="email" id="lname" name="email" placeholder="Votre email..." required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="col-lg-4">
                            <label for="mdp">Mot de passe</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="password" id="lname" name="pass" placeholder="*****" required="">
                        </div>
                    </div>

                </div>
                <p class="formButton">
                    <button type="submit" id="search_btn" class="btn btn-round btn-orange"><i class="">Connexion</i></button>

                </p>
                <br>
                <br>
                <a class="pull-left " id="showResetPassword" title="Password Lost and Found">Mot de passe oublié?</a>

            </form>
            <br>

            <br>

            <div class="reset" id="form_reset_password" >

                <form  action="<?php echo base_url() . 'Login_controller/resetPassword' ?>" id="forget-mdp" method="post" style="">



                    <h2 class="title ">Veuillez saisir votre adresse e-mail pour réinitialiser votre mot de passe.</h2>

                    <div class="col-75">
                        <input  type="email" id="lname" name="email" placeholder="Votre email..." required="">
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>
                    <p class="formButton">
                        <button type="submit" id="search_btn" class="btn btn-round btn-orange"><i class="">Réinitialiser</i></button>

                    </p>
                    <br>
                    <br>
                    <a class="pull-left " id="retour" ><< Retour</a>



                </form>

            </div>
        </div>
<script>
    $('#showResetPassword').click(function () {
        $('#form_reset_password').css("visibility", "visible");
    });
    $('#hideForm').click(function () {
        $('#form_reset_password').css("visibility", "hidden");
    });





</script>
    </body>




    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->



  













            </div>
        </div>
<script>
    $('#showResetPassword').click(function () {
        $('#form_reset_password').css("visibility", "visible");
    });
    $('#hideForm').click(function () {
        $('#form_reset_password').css("visibility", "hidden");
    });





</script>
    </body>




    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->



  











