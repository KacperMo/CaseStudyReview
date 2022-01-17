<?php
require_once 'inc/register-login-script.php';
require_once 'inc/head.php';
?>
<!DOCTYPE html>
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<body>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <!-- <img src="images/elements/Books.jpg"/> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Witaj ponownie!</h1>
                                    </div>

                                    <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="on">

                                        <div class="form-group">
                                            <input required type="email" class="form-control form-control-user" name="email" value="<?php echo $email; ?>" placeholder="Adres email">

                                        </div>

                                        <div class="form-group">
                                            <input required type="password" class="form-control form-control-user" placeholder="Hasło" name="password" autocomplete="off">
                                        </div>
                                        <!--      
                <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck"></label>
                  </div>
                </div>-->

                                        <input type="submit" name="login_user" class="btn btn-primary btn-user btn-block" value="Zaloguj">

                                        <hr>
                                        <a href="register.php" class="btn btn-google btn-user btn-block">
                                            Zarejestruj
                                        </a>
                                        <a href="remind.php" class="btn btn-facebook btn-user btn-block">
                                            Zapomniałeś hasła?
                                        </a>
                                    </form>

                                    <hr>
                                    <!-- <div class="text-center">
                <a class="small" href="forgot-password.php">Zapomniałeś hasła?</a>
              </div>
              <div class="text-center">
                <a class="small" href="register.php">Załóż konto!</a>
              </div>-->
                                    <!-- <p> <a href="index.php">Strona główna </a> </p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
    require_once('inc/footer.php');
    ?>
</body>

</html>