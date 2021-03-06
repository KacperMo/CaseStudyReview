<?php
require_once 'inc/publication-scripts.php';
require_once 'inc/navbar.php';
require_once 'inc/head.php';
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
                                <a href="add-publication.php">Dodaj publikacje</a>
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
        <?php include "inc/user-menu.php" ?>
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8 col-md-7">

                            <div class="upload_modules">

                                <!-- end /.module_title -->

                                <div class="modules__content">
                                    <div class="form-group">
                                        <label for="category">Kategoria</label>
                                        <div class="select-wrap select-wrap2">
                                            <select name="category" id="category" class="text_field" required>
                                                <option value="IT">IT</option>
                                                <option value="graphic">Graphics</option>
                                                <option value="illustration">Illustration</option>
                                                <option value="music">Music</option>
                                                <option value="video">Zarz??dzanie</option>
                                            </select>
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Tytu?? opracowania
                                            <span>(Max. 50 znak??w)</span>
                                        </label>
                                        <input type="text" id="title" name="title" class="text_field" placeholder="Tytu?? twojego opracowania..." onfocus="this.placeholder = '...'" required onblur="this.placeholder = 'Tytu?? swojego opracowania...'">
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label for="tags">Tagi
                                            <span>(Max. 5)</span>
                                        </label>
                                        <input type="text" id="tags" name="tags" class="text_field" placeholder="Tagi" onfocus="this.placeholder = '...'" onblur="this.placeholder = 'Tagi'" required class="single-input">
                                    </div>
                                    -->
                                    <div class="form-group">
                                        <label for="abstract">Streszczenie
                                            <span>(Max. 200 znak??w )</span>
                                        </label>
                                        <textarea id="abstract" name="abstract" class="text_field" placeholder="Opis kr??tki" onfocus="this.placeholder = '...'" onblur="this.placeholder = 'Uzupe??nij'" required></textarea>
                                    </div>

                                    <div class="form-group no-margin">
                                        <p class="label">Opis</p>
                                        <textarea class="text_field" id="description" name="description" placeholder="Pe??en opis publikacji"></textarea>
                                    </div>
                                </div>
                                <!-- end /.modules__content -->
                            </div>
                            <!-- end /.upload_modules -->




                            <!-- submit button -->
                            <button name="add_publication" type="submit" class="btn btn--round btn--fullwidth btn--lg">Wysy??am!</button>

                        </div>
                        <!-- end /.col-md-8 -->

                        <div class="col-lg-4 col-md-5">
                            <aside class="sidebar upload_sidebar">

                                <!-- start Przesy??anie JMG / PDF-->
                                <div class="sidebar-card">
                                    <div class="card-title">
                                        <h3>Prze??lij pliki</h3>
                                    </div>

                                    <div class="card_content">
                                        <div class="modules__content">
                                            <div class="form-group">
                                                <div class="upload_wrapper">
                                                    <p>Ok??adka
                                                        <span>(JPEG / PNG )</span>
                                                    </p>

                                                    <div class="custom_upload">
                                                        <label for="publication_cover">
                                                            <input type="file" class="files" name="publication_cover" id="publication_cover" multiple />
                                                            <span class="btn btn--round btn--sm">Wybierz</span>
                                                        </label>
                                                    </div>
                                                    <!-- end /.custom_upload -->

                                                    <div class="progress_wrapper">
                                                        <div class="labels clearfix">
                                                            <p>Ok??adka.jpg</p>
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
                                                    <label for="publication_pdf">
                                                        <input required type="file" class="files" name="publication_pdf" id="publication_pdf" multiple />
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
                                            <p class="label">Chc?? aby dokument by?? publiczny</p>
                                            <div class="custom-radio">
                                                <input type="radio" id="ryes" class="" name="isPublic" value="yes">
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
                                <!-- end Przesy??anie JMG / PDF-->

                                <div class="sidebar-card">
                                    <div class="card-title">
                                        <h3>Wa??ne</h3>
                                    </div>
                                    <!-- start Info + Podpis-->
                                    <div class="card_content">

                                        <p>Publikuj??c opracowanie:</p>
                                        <ul>
                                            <li>Wyra??asz zgod?? na przetwarzanie danych osobowych, wi??cej <a href="">tutaj</a></li>
                                            <li>Zgadzasz si?? na publikacj?? dokumentu w sieci.</li>

                                        </ul>

                                    </div>

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