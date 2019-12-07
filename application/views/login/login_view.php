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

<!--                <form name="loginform" id="loginform" action="<?php echo base_url() . 'Login_controller/loginUser' ?>" method="post">
                    <p>
                        <label for="user_login">Votre email :<br /></label>
                            <input type="email" name="log" id="user_login" class="input" placeholder="Saisissez votre email"value="" size="20" autofocus/>
                    </p>
                    <p>
                        <label for="user_pass">Votre mot de passe : <br /></label>
                            <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" autofocus/>
                    </p>


                    <p class="submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Connexion" />
                    </p>
                </form>-->
<form  id="loginForm" action="<?php echo base_url() . 'Login_controller/loginUser' ?>" method="POST" enctype="multipart/form-data">


                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="col-lg-4">
                            <label for="email">Votre e-mail</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="email" name="log" placeholder="Votre email..." required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="col-lg-4">
                            <label for="mdp">Votre mot de passe</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="password" name="pwd" placeholder="*****" required ">
                        </div>
                    </div>

                </div>
                <p class="submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Connexion" />
                    </p>
                <br>
                <br>

            </form>
                <p id="nav">
                    <a class="pull-left" id="showResetPassword" title="Password Lost and Found">Mot de passe oublié?</a>

                </p>
                <br>
                <br>
                <br>
                <form class="form-vertical box" id="form_reset_password" action="<?php echo base_url() . 'Login_controller/resetPassword' ?>"  method="post" style="margin-top:20px; visibility:hidden;">

                    <div class="form-group has-feedback" >
                        <div class="">
                            <label> Email Address </label>
                            <input type="email" name="log" id="user_login" class="input" value="" placeholder="Saisissez votre email" size="20" />
                            <i class="icon-envelope form-control-feedback"></i>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                        <div class="text-left">
                            <p style="display: inline-block;width: 10em;float: none"><input  style="background: #ffffff; color: rgb(63, 189, 209);" type="submit" name="reinitialiser" id="wp-submit" class="btn btn-danger btn-block" value="Réinitialiser" /></p>
                            <p  style="display: inline-block;width: 10em;float: none"><input style="background: rgb(63, 189, 209); color: #ffffff"  id="hideForm" class="btn  btn-block" name="Annuler" id="wp-submit"  value="Annuler" /></p>

                        </div>
                    </div>


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
