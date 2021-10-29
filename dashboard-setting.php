<?php  

    session_start();
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
        require_once('header.php');
        require_once('navibar.php');
        require_once "connect.php";
    }else{
        echo
         error_reporting(E_ALL); 
         ini_set("display_errors", 1);
         header("Location: index.php");
         die();   
        
    }
?>
<body class="preload dashboard-setting">


    <?php
   

    // use when all cols in users table created, also change from 'logindata' to 'users'
    $query = "SELECT * FROM `users` WHERE `users`.`userID` = 2";
    $result = mysqli_query($polaczenie, $query) or die(mysqli_error($polaczenie));
    $user = $result->fetch_assoc();
   
    //this is the structure that is being used
    $user = array(
        'accountName' => 'kciesla',
        'name' => 'Kamil',
        'surname' => 'Cieśla',
        'dateOfRegistration' => '2021',
        'email' => 'kamilciesla34@gmail.com',
        'website' => 'https://www.xyz.com',
        'country' => 'Poland',
        'motto' => 'FullStack',
        'aboutMe' => 'im a new user...',
        'colleges' => 'uek',
    );
   
    ?>



    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area" style="background-image: url(images/library-869061.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">

                    </div>
                    <h1 class="page-title"> " Życie jest jak tabliczka czekolady ,,</h1>
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
    <section class="dashboard-area">
        <div class="dashboard_menu_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="dashboard_menu">
                            <li>
                                <a href="author.php">
                                    <span class="lnr lnr-home"></span>Podgląd profilu</a>
                            </li>
                            <li class="active">
                                <a href="dashboard-setting.php">
                                    <span class="lnr lnr-cog"></span>Ustawienia konta</a>
                            </li>
                            <!--  <li>
                                <a href="dashboard-purchase.html">
                                    <span class="lnr lnr-cart"></span>Purchase</a>
                            </li>
                            <li>
                                <a href="dashboard-add-credit.html">
                                    <span class="lnr lnr-dice"></span>Add Credits</a>
                            </li>
                            <li>
                                <a href="dashboard-statement.html">
                                    <span class="lnr lnr-chart-bars"></span>Statements</a>
                            </li> -->
                            <li>
                                <a href="addsolution.php">
                                    <span class="lnr lnr-upload"></span>Dodaj publikacje</a>
                            </li>
                            <li>
                                <a href="publications-list.php">
                                    <span class="lnr lnr-briefcase"></span>Opublikowane</a>
                            </li>
                        </ul>
                        <!-- end /.dashboard_menu -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="dashboard__title">
                                <h3>Ustawienia Konta</h3>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <form class="setting_form" action="update-user-settings.php" method="post" autocomplete="on">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="information_module">
                                <a class="toggle_title" href="#collapse2" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Personal Information
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set toggle_module collapse show" id="collapse2">
                                    <div class="information_wrapper form--fields">
                                        <div class="form-group">
                                            <label for="acname">Account Name
                                                <sup>*</sup>
                                            </label>
                                            <input name="accountName" type="text" id="acname" class="text_field" placeholder="Account Name" value="<?php echo $user['accountName'] ?>">

                                        </div>

                                        <div class=" form-group">
                                            <label for="usrname">Username
                                                <sup>*</sup>
                                            </label>
                                            <input name="name" type="text" id="usrname" class="text_field" placeholder="Username" value="<?php echo $user['name'] ?>">
                                            <p>Twój profil będzie dostępny pod adresem URL: <a href="https://casestudyreview.pl/<?php echo $user['accountName'] ?>">https://casestudyreview.pl/<?php echo $user['accountName'] ?>
                                                </a></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="emailad">Email Address
                                                <sup>*</sup>
                                            </label>
                                            <input name="email" type="text" id="emailad" class="text_field" placeholder="Email address" value="<?php echo $user['email'] ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Password
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="password" id="password" class="text_field" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="conpassword">Confirm Password
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="password" id="conpassword" class="text_field" placeholder="Re-enter password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input name="website" type="text" id="website" class="text_field" placeholder="Website" value="<?php echo $user['website'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="country">Country
                                                <sup>*</sup>
                                            </label>
                                            <div class="select-wrap select-wrap2">
                                                <select name="country" id="country" class="text_field" <?php echo $user['accountName'] ?>>
                                                    <option value=""><?php echo $user['country'] ?></option>
                                                    <option value="pl">Polska</option>
                                                    <option value="usa">USA</option>
                                                    <option value="en">England</option>
                                                </select>
                                                <span class="lnr lnr-chevron-down"></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="prohead">Motto</label>
                                            <input name="motto" type="text" id="prohead" class="text_field" placeholder="Ex: Webdesign & Development Service" value="<?php echo $user['motto'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="authbio">Dodaj coś od siebie</label>
                                            <textarea name="aboutMe" id="authbio" class="text_field" placeholder="Short brief about yourself or your account..."><?php echo $user['aboutMe'] ?>
                                        </textarea>
                                        </div>
                                    </div>
                                    <!-- end /.information_wrapper -->
                                </div>
                                <!-- end /.information__set -->
                            </div>
                            <!-- end /.information_module -->


                        </div>
                        <!-- end /.col-md-6 -->

                        <div class="col-lg-6">
                            <div class="information_module">
                                <a class="toggle_title" href="#collapse3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Zdjęcie profilowe & baner
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set profile_images toggle_module collapse" id="collapse3">
                                    <div class="information_wrapper">
                                        <div class="profile_image_area">
                                            <img src="images/authplc.png" alt="Author profile area">
                                            <div class="img_info">
                                                <p class="bold">Zdjęcie profilowe</p>
                                                <p class="subtitle">JPG, GIF or PNG 100x100 px</p>
                                            </div>

                                            <label for="cover_photo" class="upload_btn">
                                                <input type="file" id="cover_photo">
                                                <span class="btn btn--sm btn--round" aria-hidden="true">Prześlij zdjęcie</span>
                                            </label>
                                        </div>

                                        <div class="prof_img_upload">
                                            <p class="bold">Baner</p>
                                            <img src="images/cvrplc.jpg" alt="The great warrior of China">

                                            <div class="upload_title">
                                                <p>JPG, GIF or PNG 750x370 px</p>
                                                <label for="dp" class="upload_btn">
                                                    <input type="file" id="dp">
                                                    <span class="btn btn--sm btn--round" aria-hidden="true">Prześlij zdjęcie</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end /.information_module -->

                            <div class="information_module">
                                <a class="toggle_title" href="#collapse5" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Social
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set social_profile toggle_module collapse " id="collapse5">
                                    <div class="information_wrapper">
                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-facebook"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" placeholder="ex: www.facebook.com/aazztech">
                                            </div>
                                        </div>
                                        <!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-twitter"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" placeholder="ex: www.twitter.com/aazztech">
                                            </div>
                                        </div>
                                        <!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-google-plus"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" placeholder="ex: www.google.com/aazztech">
                                            </div>
                                        </div>
                                        <!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-behance"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" placeholder="ex: www.behance.com/aazztech">
                                            </div>
                                        </div>
                                        <!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-dribbble"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" placeholder="ex: www.dribbble.com/aazztech">
                                            </div>
                                        </div>
                                        <!-- end /.social__single -->
                                    </div>
                                    <!-- end /.information_wrapper -->
                                </div>
                                <!-- end /.social_profile -->
                            </div>
                            <!-- end /.information_module -->
                            <!-- 
                            <div class="information_module">
                                <a class="toggle_title" href="#collapse4" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Email Settings
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set mail_setting toggle_module collapse" id="collapse4">
                                    <div class="information_wrapper">
                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt1" class="" name="mail_rating_reminder" checked>
                                            <label for="opt1">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Rating Reminders</span>
                                                <span class="desc">Send an email reminding me to rate an item after purchase</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt2" class="" name="mail_update_noti" checked>
                                            <label for="opt2">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Item Update Notifications</span>
                                                <span class="desc">Send an email when an item I've purchased is updated</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt3" class="" name="mail_comment_noti" checked>
                                            <label for="opt3">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Item Comment Notifications</span>
                                                <span class="desc">Send me an email when someone comments on one of my items</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt4" class="" name="mail_item_review_noti" checked>
                                            <label for="opt4">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Item Review Notifications</span>
                                                <span class="desc">Send me an email when my items are approved or rejected</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt5" class="" name="mail_review_noti" checked>
                                            <label for="opt5">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Buyer Review Notifications</span>
                                                <span class="desc">Send me an email when someone leaves a review with their rating</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt6" class="" name="mail_support_noti" checked>
                                            <label for="opt6">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Support Notifications</span>
                                                <span class="desc">Send me emails showing my soon to expire support entitlements</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt7" class="" name="mail_weekly">
                                            <label for="opt7">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Weekly Summary Emails</span>
                                                <span class="desc">Send me emails showing my soon to expire support entitlements</span>
                                            </label>
                                        </div>

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="opt8" class="" name="mail_newsletter">
                                            <label for="opt8">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">MartPlace Newsletter</span>
                                                <span class="desc">Get update about latest news, update and more.</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                             -->
                            <!-- end /.information_module -->
                        </div>
                        <!-- end /.col-md-6 -->

                        <div class="col-md-12">
                            <div class="dashboard_setting_btn">
                                <button type="submit" class="btn btn--round btn--md">Zapisz Zmiany</button>
                            </div>
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </form>
                <!-- end /form -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->


    <?php
    @require_once('footer.php');
    ?>
</body>

</html>