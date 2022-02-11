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
                                <a href="#">Odzyskaj hasło</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Odzyskaj hasło</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="pass_recover_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="inc/password-recovery/send-message.php" method="POST" autocomplete="on">
                        <div class="cardify recover_pass">
                            <div class="login--header">
                                <p>Wpisz adres e-mail powiązany z twoim kontem Case Study Review. Następnie, w wiadomości e-mail otrzymasz link pozwalający na zresetowanie hasła.
                                </p>
                            </div>
                            <!-- end .login_header -->

                            <div class="login--form">
                                <div class="form-group">
                                    <label for="email_ad">E-mail</label>
                                    <input name="email" id="email_ad" type="text" class="text_field" required placeholder="Wpisz swój adres e-mail">
                                </div>

                                <button name="email-submit" class="btn btn--md btn--round register_btn" type="submit">Odzyskaj hasło</button>
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