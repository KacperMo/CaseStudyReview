<?php
require_once 'inc/register-login-script.php';
require_once 'inc/head.php';

?>
<!DOCTYPE html>
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<html>

<body>

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Zarejstruj się</h1>

                            </div>
                            <!--registration form    -->
                            <form class="user" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <?php require('inc/register-login-errors.php'); ?>
                                <div class="form-group row">
                                    <input required type="text" placeholder="Nazwa użytkownika" name="username" value="<?= $username; ?>" class="form-control form-control-user">
                                </div>
                                <div class="form-group">
                                    <input required type="email" class="form-control form-control-user" name="email" value="<?= $email; ?>" placeholder="Adres Email">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required type="password" class="form-control form-control-user" name="password_1" placeholder="Hasło">

                                    </div>
                                    <div class="col-sm-6">
                                        <input required type="password" class="form-control form-control-user" name="password_2" placeholder="Powtórz hasło">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <input type="text" class="form-control form-control-user" id="college" name="college" placeholder="Nazwa uczelni">
                                </div>
                                <hr>
                                <input type="submit" name="reg_user" value="Rejestruj konto" class="btn btn-primary btn-user btn-block" />


                                <!--
                    <a href="index.php" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="index.php" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a>
              </form> -->
                                <!-- END OF registration form    -->
                                <hr>
                                <div class="text-center">
                                    <!-- <a class="small" href="forgot-password.php">Zapomniałeś hasła?</a> -->
                                </div>
                                <div class="text-center">
                                    <p>
                                        Posiadasz już konto? <a href="login.php">Zaloguj się!</a>
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendors/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <?php
    require_once('inc/footer.php');
    ?>
</body>

</html>