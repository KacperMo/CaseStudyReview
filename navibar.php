 <!--================================
        START MENU AREA
    =================================-->

 <!-- start menu-area -->
 <div class="menu-area">
     <!-- start .top-menu-area -->
     <div class="top-menu-area">
         <!-- start .container -->
         <div class="container">
             <!-- start .row -->
             <div class="row">
                 <!-- start .col-md-3 -->
                 <div class="col-lg-3 col-md-3 col-6 v_middle">
                     <div class="logo">
                         <a href="index.php">
                             <!--  <img src="images/logo.png" alt="logo image" class="img-fluid"> -->
                         </a>
                     </div>
                 </div>
                 <!-- end /.col-md-3 -->

                 <!-- start .col-md-5 -->

                 <!-- end /.col-md-5 -->
             </div>
             <!-- end /.row -->
         </div>
         <!-- end /.container -->
     </div>
     <!-- end  -->

     <!-- start .mainmenu_area -->
     <div class="mainmenu">
         <!-- start .container -->
         <div class="container">
             <!-- start .row-->
             <div class="row">
                 <!-- start .col-md-12 -->
                 <div class="col-md-12">
                     <div class="navbar-header">
                         <!-- start mainmenu__search -->
                         <div class="mainmenu__search">
                             <div class="author-area">



                                 <!--start .author__notification_area -->

                                 <!--start .author-author__info-->
                                 <div class='author-author__info inline has_dropdown'>

                                     <?php
                                     session_start();
                                        // Check if the user is already logged in, if yes then redirect him to welcome page
                                        if (isset($_SESSION['loggedin']) && @($_SESSION['loggedin'] == true)) {
                                            echo "
                                                    
                                                    <div class='author__avatar'>
                                                        <img src='images/usr_avatar.png' alt='user avatar'>
                        
                                                    </div>
                                                    <div class='autor__info'>
                                                        <p class='name'>
                                                        Imie Nazwisko
                                                        </p>
                                                        
                                                    </div>
                                                    <div class='dropdowns dropdown--author'>
                                                            <ul> 
                                                                <li><a href='author.php'>
                                                                <span class='lnr lnr-user'></span>Zobacz swój profil Adam!</a>
                                                                </li>
                                                                <li>
                                                                    <a href='dashboard-setting.php'>
                                                                        <span class='lnr lnr-cog'></span> Ustawienia konta</a>
                                                                </li>
                                                                <li>
                                                                    <a href='logout.php'>
                                                                        <span class='lnr lnr-exit'></span>Waloguj</a>
                                                                </li>
                                                                
                                                            </ul>
                                                    </div>
                                                ";
                                        } else {
                                            echo "
                                                        <div class='autor__info'>
                                                            <p class='name'>
                                                            <a href='login.php'>
                                                            <span class='lnr lnr-exit'></span>Zaloguj</a>
                                                            </p>
                                                        </div> 
                                                        
                                                ";
                                        }
                                        ?>



                                 </div>
                                 <!--end /.author-author__info-->
                             </div>
                             <!-- end .author-area -->

                             <!-- author area restructured for mobile -->
                             <div class="mobile_content ">
                                 <span class="lnr lnr-user menu_icon"></span>

                                 <!-- offcanvas menu -->
                                 <div class="offcanvas-menu closed">
                                     <span class="lnr lnr-cross close_menu"></span>
                                     <div class="author-author__info">
                                         <div class="author__avatar v_middle">
                                             <img src="images/usr_avatar.png" alt="user avatar">
                                         </div>
                                         <div class="autor__info v_middle">
                                             <p class="name">
                                                 Imie Nazwisko
                                             </p>
                                         </div>
                                     </div>
                                     <!--end /.author-author__info-->

                                     <!--start .author__notification_area -->

                                     <div class="dropdowns dropdown--author">
                                         <ul>
                                             <li>
                                                 <a href="#">
                                                     <span class="lnr lnr-user"></span>Profil</a>
                                             </li>
                                             <?php
                                                // Check if the user is already logged in, if yes then redirect him to welcome page
                                                if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
                                                    echo "<li>
                                                    <a href='logout.php'>
                                                        <span class='lnr lnr-exit'></span>Waloguj</a>
                                                </li>";
                                                } else {
                                                    echo "<li><a href='author.php'>
                                                    <span class='lnr lnr-user'></span>Profil</a>
                                                </li><li>
                                                    <a href='login.php'>
                                                        <span class='lnr lnr-exit'></span>Zaloguj</a>
                                                </li>";
                                                }
                                                ?>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                             <!-- end /.mobile_content -->


                         </div>
                         <!-- start mainmenu__search -->
                     </div>

                     <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon"></span>
                         </button>
                         <!-- Collect the nav links, forms, and other content for toggling -->
                         <div class="collapse navbar-collapse" id="navbarNav">
                             <ul class="navbar-nav">
                                 <li class="has_dropdown">
                                     <a href="index.php">Główna</a>
                                 </li>
                                 <li class="has_dropdown">
                                     <a href="publications-grid.php">Publikacje</a>
                                 </li>
                                 <li class="has_dropdown">
                                     <a href="contact.php">O nas</a>
                                 </li>
                             </ul>
                         </div>
                         <!-- /.navbar-collapse -->
                     </nav>
                 </div>
                 <!-- end /.col-md-12 -->
             </div>
             <!-- end /.row-->
         </div>
         <!-- start .container -->
     </div>
     <!-- end /.mainmenu-->
 </div>
 <!-- end /.menu-area -->
 <!--================================
        END MENU AREA
    =================================-->