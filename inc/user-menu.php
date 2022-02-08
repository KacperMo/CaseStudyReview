 <!--================================
            START DASHBOARD AREA
    =================================-->
 <?php
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user_id'];
    ?>
 <div class="dashboard_menu_area">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <ul class="dashboard_menu">
                     <li>
                         <a href="user-profile.php">
                             <span class="lnr lnr-home"></span>Podgląd profilu</a>
                     </li>
                     <?php if ($user_id == $_SESSION['user_id']) : ?>
                         <li>
                             <a href="user-settings.php">
                                 <span class="lnr lnr-cog"></span>Ustawienia konta</a>
                         </li>
                         <li>
                             <a href="add-publication.php">
                                 <span class="lnr lnr-upload"></span>Dodaj publikacje</a>
                         </li>
                     <?php endif; ?>
                     <li>
                         <a href="publications-list.php?user_id=<?= $user_id ?> ">
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
 <script src="js/vendor/jquery/jquery-1.12.3.js"></script>
 <script>
     $(".dashboard_menu li").each(function() {
         if (this.children[0].href == document.URL) {
             $(this).addClass('active');
         }
     });
 </script>