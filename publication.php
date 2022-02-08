<?php
require_once 'inc/head.php';
require_once 'inc/navbar.php';
require_once 'inc/publication-scripts.php';
$publication = get_publication($db, $_GET['publication_id']);
?>

<body class="preload single_prduct2">
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
                                <a href="index.php">Główna</a>
                            </li>
                            <li>
                                <a href="publications-grid.php">Publikacje</a>
                            </li>
                        </ul>
                    </div>

                    <h1 class='page-title'><?= $publication['title'] ?></h1>
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


    <!--============================================
        START SINGLE PRODUCT DESCRIPTION AREA
    ==============================================-->
    <section class="single-product-desc single-product-desc2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="item-preview item-preview2">
                        <div class="prev-slide">
                            <img src='<?= $publication['cover_path'] ?>' alt='<?= $publication['title'] ?>'>

                        </div>



                        <div class="tab tab2">
                            <div class="item-navigation">
                                <ul class="nav nav-tabs nav--tabs2">
                                    <li>
                                        <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">Opracowanie</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.item-navigation -->

                            <div class="tab-content">
                                <div class="tab-pane fade product-tab active show" id="product-details">
                                    <div class='tab-content-wrapper'>

                                        <h1><?= $publication['title'] ?></h1>
                                        <p><?= $publication['abstract'] ?></p>
                                        <?php if ($publication['description'] != '') : ?>
                                            <h2>Opis</h2>
                                            <p><?= $publication['description'] ?></p>
                                        <?php endif ?>
                                        <img src='<?= $publication['publication_preview_path'] ?>' alt='<?= $publication['title'] ?>' style='margin-bottom: 0px; padding-bottom: 0px;'>
                                    </div>
                                </div>
                                <!-- end /.tab-content -->

                            </div>
                            <!-- end /.tab-content -->
                        </div>
                        <!-- end /.item-info -->
                    </div>
                    <!-- end /.item-preview-->
                </div>
                <!-- end /.col-md-8 -->


                <!-- start right side -->
                <div class="col-lg-4">
                    <aside class="sidebar sidebar--single-product">
                        <div class="author-card sidebar-card ">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    <img src="<?= $publication['profile_image'] ?>" alt="user avatar">
                                </div>

                                <div class="author">
                                    <h4><?= $publication['first_name'] ?> <?= $publication['surname'] ?> </h4>

                                </div>
                                <!-- end /.author -->
                                <!-- <div class="social social--color--filled">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <span class="fa fa-facebook"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="fa fa-twitter"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="fa fa-dribbble"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> -->
                                <!-- end /.social -->

                                <div class="author-btn">
                                    <a href="user-profile.php?user_id=<?= $publication['sender_id'] ?> " class="btn btn--sm btn--round"> Profil</a>
                                    <a href="#" class="btn btn--sm btn--round">Wiadomość</a>
                                </div>
                                <!-- end /.author-btn -->

                            </div>
                            <!-- end /.author-infos -->


                        </div>
                        <!-- end /.sidebar--card -->

                        <div class="sidebar-card card--metadata">
                            <ul class="data">
                                <li>
                                    <p>
                                        <span class="lnr lnr-eye mcolor4"></span>Wyświetlenia
                                    </p>
                                    <span><?= $publication['views'] ?> </span>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.sidebar-card -->

                        <div class="sidebar-card card--product-infos">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <ul class="infos">
                                <li>
                                    <p class="data-label">Dodano</p>
                                    <p class="info"><?= $publication['submission_date'] ?> </p>
                                </li>
                                <li>
                                    <p class="data-label">File type</p>
                                    <p class="info">PDF</p>
                                </li>
                                <li>
                                    <p class="data-label">Kategoria</p>
                                    <p class="info"><?= $publication['category'] ?> </p>
                                </li>
                                <li>
                                    <p class="data-label">Licencja</p>
                                    <p class="info">Nieznana</p>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.aside -->
                    </aside>
                    <!-- end /.aside -->
                </div>
                <!-- end right side -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->
    <?php
    @require_once('inc/footer.php');
    ?>
</body>

</html>