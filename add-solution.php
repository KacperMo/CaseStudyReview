<?php
require_once('navibar.php');
require_once('head.php');
?>

<body class="preload dashboard-upload">
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
                                <a href="addsolution.php">Dodaj publikacje</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Twoja wiedza jest dla nas najwazniejsza</h1>
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
                                    <span class="lnr lnr-home"></span>Twój profil</a>
                            </li>
                            <li>
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
                            <li class="active">
                                <a href="addsolution.php">
                                    <span class="lnr lnr-upload"></span>Dodaj publikacje</a>
                            </li>
                            <li>
                                <a href="dashboard-manage-item.html">
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
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Dodaj opracowanie</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8 col-md-7">

                            <div class="upload_modules">

                                <!-- end /.module_title -->

                                <div class="modules__content">
                                    <div class="form-group">
                                        <label for="category">Kategoria</label>
                                        <div class="select-wrap select-wrap2">
                                            <select name="Category" id="category" class="text_field" required>
                                                <option value="IT">IT</option>
                                                <option value="graphic">Graphics</option>
                                                <option value="illustration">Illustration</option>
                                                <option value="music">Music</option>
                                                <option value="video">Zarządzanie</option>
                                            </select>
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Title">Tytuł opracowania
                                            <span>(Max. 50 znaków)</span>
                                        </label>
                                        <input type="text" id="Title" name="Title" class="text_field" placeholder="Tytuł swojego opracowania..." onfocus="this.placeholder = '...'" required onblur="this.placeholder = 'Tytuł swojego opracowania...'">
                                    </div>

                                    <div class="form-group">
                                        <label for="Tags">Tagi
                                            <span>(Max. 5)</span>
                                        </label>
                                        <input type="text" id="Tags" name="Tags" class="text_field" placeholder="Tagi" onfocus="this.placeholder = '...'" onblur="this.placeholder = 'Tagi'" required class="single-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="abstract">Streszczenie
                                            <span>(Max. 200 znaków )</span>
                                        </label>
                                        <textarea id="abstract" name="abstract" class="text_field" placeholder="Opis krótki" onfocus="this.placeholder = '...'" onblur="this.placeholder = 'Uzupełnij'" required></textarea>
                                    </div>

                                    <div class="form-group no-margin">
                                        <p class="label">Opis</p>
                                        <textarea class="text_field" id="description" name="description" placeholder="Pełen opis publikacji"></textarea>
                                    </div>
                                </div>
                                <!-- end /.modules__content -->
                            </div>
                            <!-- end /.upload_modules -->




                            <!-- submit button -->
                            <button type="submit" class="btn btn--round btn--fullwidth btn--lg">Wysyłam!</button>

                        </div>
                        <!-- end /.col-md-8 -->

                        <div class="col-lg-4 col-md-5">
                            <aside class="sidebar upload_sidebar">

                                <!-- start Przesyłanie JMG / PDF-->
                                <div class="sidebar-card">
                                    <div class="card-title">
                                        <h3>Prześlij pliki</h3>
                                    </div>

                                    <div class="card_content">
                                        <div class="modules__content">
                                            <div class="form-group">
                                                <div class="upload_wrapper">
                                                    <p>Okładka
                                                        <span>(JPEG / PNG )</span>
                                                    </p>

                                                    <div class="custom_upload">
                                                        <label for="uploadJPG">
                                                            <input type="file" class="files" name="uploadJPG" id="uploadJPG" multiple />
                                                            <span class="btn btn--round btn--sm">Wybierz</span>
                                                        </label>
                                                    </div>
                                                    <!-- end /.custom_upload -->

                                                    <div class="progress_wrapper">
                                                        <div class="labels clearfix">
                                                            <p>Okładka.jpg</p>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- end /.progress_wrapper -->
                                            </div>
                                            <!-- end /.upload_wrapper -->
                                        </div>
                                        <!-- end /.form-group -->

                                        <div class="form-group ">
                                            <div class="upload_wrapper">
                                                <p>Opracowanie
                                                    <span>(PDF)</span>
                                                </p>

                                                <div class="custom_upload">
                                                    <label for="uploadPDF">
                                                        <input type="file" class="files" name="uploadPDF" id="uploadPDF" multiple />
                                                        <span class="btn btn--round btn--sm">Wybierz</span>
                                                    </label>
                                                </div>

                                                <!-- end /.custom_upload -->

                                                <div class="progress_wrapper">
                                                    <div class="labels clearfix">
                                                        <p>Opracowanie.pdf</p>
                                                    </div>
                                                </div>
                                                <!-- end /.progress_wrapper -->
                                            </div>
                                            <!-- end /.upload_wrapper -->
                                        </div>
                                        <!-- end /.form-group -->

                                        <div class="form-group radio-group">
                                            <p class="label">Chcę aby dokument był publiczny</p>
                                            <div class="custom-radio">
                                                <input type="radio" id="ryes" class="" name="isPublic" value="yes" checked>
                                                <label for="ryes"><span class="circle"></span>Tak</label>
                                            </div>

                                            <div class="custom-radio">
                                                <input type="radio" id="rno" class="" name="isNotPublic">
                                                <label for="rno"><span class="circle"></span>Nie</label>
                                            </div>
                                        </div>
                                        <!-- end /.checkbox group -->
                                    </div>
                                </div>
                                <!-- end Przesyłanie JMG / PDF-->

                                <div class="sidebar-card">
                                    <div class="card-title">
                                        <h3>Ważne</h3>
                                    </div>
                                    <!-- start Info + Podpis-->
                                    <div class="card_content">

                                        <p>Publikując opracowanie:</p>
                                        <ul>
                                            <li>Wyrażasz zgodę na przetwarzanie danych osobowych, więcej <a href="">tutaj</a></li>
                                            <li>Zgadzasz się na publikację dokumentu w sieci.</li>

                                        </ul>

                                    </div>
                                    <?php
                                    // Check if the user is already logged in, if yes then redirect him to welcome page
                                    if ((@$_SESSION['logged_in'] == false)) {
                                        echo '<div class="form-group">
                                                    <label for="dimension">Autor</label>
                                                    <input type="text" name="autor" id="autor" class="text_field" placeholder="np. Mgr. Jan Kowalski">
                                                </div>';
                                    }
                                    ?>

                                </div>
                                <!-- end Info + Podpis-->
                            </aside>
                            <!-- end /.sidebar -->
                        </div>
                        <!-- end /.col-md-4 -->

                    </div>
                    <!-- end /.row -->
                </form>
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section> -->
    <!--================================
            END DASHBOARD AREA
    =================================-->
    <?php
    @require_once('inc/footer.php');
    ?>

</body>

</html>