<?php
include_once('inc/head.php');
?>

<body class="preload recover-pass-page">
    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <a href="#">Zmień hasło</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Zmień hasło</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--===============================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="pass_recover_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="/inc/password-recovery/change-password.php?token=<?php echo $_GET['token'] ?>" method="POST" autocomplete="on">
                        <div class="cardify recover_pass">
                            <div class="login--header">
                                <p>Wpisz nowe hasło, którego będziesz używał do logowania do twojego konta.
                                </p>
                            </div>
                            <div class="login--form">
                                <div class="form-group">
                                    <label for="password1">Nowe hasło</label>
                                    <input name="password1" id="password1" type="password" class="text_field" required placeholder="Wpisz swoje nowe hasło">
                                </div>
                                <div class="form-group">
                                    <label for="password2">Powtórz hasło</label>
                                    <input name="password2" id="password2" type="password" class="text_field" required placeholder="Wpisz swoje nowe hasło">
                                </div>
                                <button name="password-submit" class="btn btn--md btn--round register_btn" type="submit">Zmień hasło</button>
                            </div>
                            <!-- end .login--form -->
                        </div>
                        <!-- end .cardify -->
                    </form>
                </div>
                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
</body>