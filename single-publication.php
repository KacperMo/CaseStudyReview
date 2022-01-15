<?php
require_once('inc/head.php');
require_once('inc/navibar.php');

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

                    <?php
                    require_once("showpublication.php");
                    $get_solutions = get_solutions();
                    //Tutaj sprawdzić czy wnaleziono jakiekolwiek wyniki!-------------------                        

                    foreach ($get_solutions->publication_data as $row) {
                    }
                    echo " <h1 class='page-title'>$row[title]</h1>";
                    ?>
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
                            <?php
                            echo "<img src='$row[img_src]' alt='$row[title]'>";
                            ?>

                        </div>



                        <div class="tab tab2">
                            <div class="item-navigation">
                                <ul class="nav nav-tabs nav--tabs2">
                                    <li>
                                        <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">Opracowanie</a>
                                    </li>
                                    <li>
                                        <a href="##product-comment" aria-controls="product-comment" role="tab" data-toggle="tab">Kommentarze </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.item-navigation -->

                            <div class="tab-content">
                                <div class="tab-pane fade product-tab active show" id="product-details">
                                    <?php
                                    echo "<div class='tab-content-wrapper'>

                                    <h1>" . $row['title'] . "</h1>
                                    <p>" . $row['abstract'] . "</p>
                                    <h2>Opis</h2>
                                    <ul>
                                    <p>" . $row['description'] . "</p>
                                    </ul>";

                                    if (file_exists($row['src'] . 'pageone.jpg')) {
                                        echo "<img src='" . $row['src'] . 'pageone.jpg' . "' alt='$row[title]' style='margin-bottom: 0px; padding-bottom: 0px;'>";
                                    }
                                    echo "</div>";
                                    ?>




                                </div>
                                <!-- end /.tab-content -->
                                <!--============================================
        START COMENT AREA
    ==============================================-->
                                <div class="tab-pane product-tab fade" id="product-comment">
                                    <div class="thread">
                                        <ul class="media-list thread-list">
                                            <li class="single-thread">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/m1.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div>
                                                            <div class="media-heading">
                                                                <a href="author.html">
                                                                    <h4>Themexylum</h4>
                                                                </a>
                                                                <span>9 Hours Ago</span>
                                                            </div>
                                                            <a href="#" class="reply-link">Reply</a>
                                                        </div>
                                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo
                                                            ut sceleris que the mattis, leo quam aliquet congue placerat
                                                            mi id nisi interdum mollis. </p>
                                                    </div>
                                                </div>

                                                <!-- nested comment markup -->
                                                <ul class="children">
                                                    <li class="single-thread depth-2">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <a href="#">
                                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-heading">
                                                                    <h4>AazzTech</h4>
                                                                    <span>6 Hours Ago</span>
                                                                </div>
                                                                <span class="comment-tag author">Author</span>
                                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra,
                                                                    justo ut sceleris que the mattis, leo quam aliquet congue
                                                                    placerat mi id nisi interdum mollis. </p>
                                                            </div>
                                                        </div>

                                                    </li>
                                                </ul>

                                                <!-- comment reply -->
                                                <div class="media depth-2 reply-comment">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <form action="#" class="comment-reply-form">
                                                            <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                            <button class="btn btn--md btn--round">Post Comment</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- comment reply -->
                                            </li>
                                            <!-- end single comment thread /.comment-->

                                            <!-- end single comment thread /.comment-->
                                        </ul>
                                        <!-- end /.media-list -->


                                        <!-- end /.comment pagination area -->

                                        <div class="comment-form-area">
                                            <h4>Leave a comment</h4>
                                            <!-- comment reply -->
                                            <div class="media comment-form">

                                                <div class="media-body">
                                                    <form action="#" class="comment-reply-form">
                                                        <textarea name="reply-comment" placeholder="Write your comment..."></textarea>
                                                        <button class="btn btn--sm btn--round">Post Comment</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- comment reply -->
                                        </div>
                                        <!-- end /.comment-form-area -->
                                    </div>
                                    <!-- end /.comments -->
                                </div>
                                <!-- end /.product-comment -->
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
                                <?php
                                echo '
                                       
                                            <div class="author_avatar">
                                                <img src="images/usr_avatar.png" alt="user avatar">
                                            </div>
            
                                            <div class="author">
                                            <h4>' . $row['autornIFnotlLogIn'] . '</h4>
                                                
                                            </div>
                                            <!-- end /.author -->            
                                          ';
                                ?>
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
                                    <a href="#" class="btn btn--sm btn--round"> Profil</a>
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
                                    <span>0</span>
                                </li>
                                <li>
                                    <p>
                                        <span class="lnr lnr-bubble mcolor3"></span>Kommentarze
                                    </p>
                                    <span>0</span>
                                </li>

                                <li>
                                    <p>
                                        <span class="lnr lnr-heart scolor"></span>Polubień
                                    </p>
                                    <span>0</span>
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
                                    <p class="info">16 June 2015</p>
                                </li>
                                <li>
                                    <p class="data-label">Ilość ocen</p>
                                    <p class="info">28 </p>
                                </li>
                                <li>
                                    <p class="data-label">File type</p>
                                    <p class="info">PDF</p>
                                </li>
                                <li>
                                    <p class="data-label">Kategoria</p>
                                    <p class="info">IT</p>
                                </li>
                                <li>
                                    <p class="data-label">Licencja</p>
                                    <p class="info">open</p>
                                </li>
                                <li>
                                    <p class="data-label">Tags</p>
                                    <p class="info">
                                        <a href="#">business</a>,
                                        <a href="#">template</a>,
                                        <a href="#">onepage</a>,
                                        <a href="#">creative</a>
                                    </p>
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