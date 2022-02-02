<?php
require_once 'inc/head.php';
require_once 'inc/navbar.php';
require_once "inc/publications-script.php";

if (!isset($_SESSION)) {
    session_start();
}
$publications = get_publications($db);

?>

<body class="preload home3">

    < <!--================================START SEARCH AREA=================================-->
        <section class="search-wrapper">
            <div class="search-area2 bgimage">
                <div class="bg_image_holder">
                    <img src="images/library-869061.jpg" alt="library">
                </div>
                <div class="container content_above">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="search">
                                <div class="search__title">
                                    <h3>
                                        <span></span>
                                    </h3>
                                </div>
                                <div class="search__field">
                                    <form action="publication-grid.php">
                                        <div class="field-wrapper">
                                            <input class="relative-field rounded" type="text" placeholder="Automatyzacja i rozwój">
                                            <button class="btn btn--round" type="submit">Szukaj</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="breadcrumb">
                                    <ul>
                                        <li>
                                            <a href="#products">
                                                <?php
                                                echo "Znaleziono " . count($publications) . " publikacji";
                                                ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.row -->
                </div>
                <!-- end /.container -->
            </div>
            <!-- end /.search-area2 -->
        </section>
        <!--================================
        END SEARCH AREA
    =================================-->

        <!--================================
        START FILTER AREA
    =================================-->
        <div class="filter-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-bar">
                            <div class="filter__option filter--dropdown">
                                <a href="#" id="drop1" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategorie
                                    <span class="lnr lnr-chevron-down"></span>
                                </a>
                                <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop1">
                                    <li>
                                        <a href="#">IT
                                            <span>35</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- end /.filter__option -->

                            <div class="filter__option filter--dropdown">
                                <a href="#" id="drop2" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sortuj po
                                    <span class="lnr lnr-chevron-down"></span>
                                </a>
                                <ul class="custom_dropdown dropdown-menu" aria-labelledby="drop2">
                                    <li>
                                        <a href="#">Popularne</a>
                                    </li>
                                    <li>
                                        <a href="#">Najnowsze</a>
                                    </li>
                                    <li>
                                        <a href="#">Najlepiej oceniane </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- end /.filter__option -->


                            <!--   <div class="filter__option filter--select">
                            <div class="select-wrap">
                                <select name="date">
                                    <option value="low"> od najnowwszych</option>
                                    <option value="high"> od najstarszych</option>
                                </select>
                                <span class="lnr lnr-chevron-down"></span>
                            </div>
                        </div> -->
                            <!-- end /.filter__option -->

                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select name="publicationPerPage">
                                        <option value="12" selected="selected">ilość na stronie</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="45">45</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                            </div>
                            <!-- end /.filter__option -->

                            <div class="filter__option filter--layout">
                                <a href="publications-grid.php">
                                    <div class="svg-icon">
                                        <img class="svg" src="images/svg/grid.svg" alt="it's just a layout control folks!">
                                    </div>
                                </a>
                                <a href="publications-list.php">
                                    <div class="svg-icon">
                                        <img class="svg" src="images/svg/list.svg" alt="it's just a layout control folks!">
                                    </div>
                                </a>
                            </div>
                            <!-- end /.filter__option -->
                        </div>
                        <!-- end /.filter-bar -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>

                <!-- end filter-bar -->
            </div>
        </div>
        <!-- end /.filter-area -->
        <!--================================
        END FILTER AREA
    =================================-->
        <!--================================
        START PRODUCTS AREA
    =================================-->
        <section class="products section--padding2">
            <!-- start container -->
            <div class="container">



                <?php foreach ($publications as $publication) : ?>
                    <!-- start .row -->
                    <div class='row'>
                        <!-- start .col-md-4 -->
                        <div class='col-md-12'>
                            <!-- start .single-product -->
                            <div class='product product--list'>

                                <div class='product__thumbnail'>

                                    <img src='images/lp1.jpg' alt='Product Image'>
                                    <div class='prod_btn'>
                                        <div class='prod_btn__wrap'>
                                            <a href='single-publication.php?publication_id=$publication[' publication_id']}' class='transparent btn--sm btn--round'>Czytaj Dalej</a>
                                        </div>
                                    </div>
                                    <!-- end /.prod_btn -->
                                </div>
                                <!-- end /.product__thumbnail -->

                                <div class='product__details'>
                                    <div class='product-desc'>
                                        <a href='single-publication.php?publication_id=$publication[publication_id]' class='product_title'>
                                            <h4><?= $publications['title'] ?></h4>
                                        </a>
                                        <p><?= $publications['abstract'] ?></p>

                                        <ul class='titlebtm'>
                                            <li class='product_cat'>
                                                <a href='#'>
                                                    <span class='lnr lnr-book'></span>IT</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end /.product-desc -->

                                    <div class='product-meta'>
                                        <div class='author'>
                                            <img class='auth-img' src='images/auth3.jpg' alt='author image'>
                                            <p>
                                                <a href='#'>Imie Nazwisko</a>
                                            </p>
                                        </div>

                                        <div class='product-tags'>
                                            <span>Tags:</span>
                                            <ul>
                                                <li>
                                                    <a href='#'>plugins</a>
                                                </li>
                                                <li>
                                                    <a href='#'>wordpress</a>
                                                </li>
                                                <li>
                                                    <a href='#'>dynamic</a>
                                                </li>
                                                <li>
                                                    <a href='#'>php</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <!-- end product-meta -->

                                    <div class='product-purchase'>
                                        <div class='price_love'>
                                            <span>IT</span>
                                        </div>
                                        <div class='sell'>
                                            <p>
                                                <span class='lnr lnr-heart'></span> 90 wyświetleń
                                            </p>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- end /.product-purchase -->
                                </div>
                            </div>
                            <!-- end /.single-product -->


                        </div>
                        <!-- end /.col-md-4 -->
                    </div>
                    <!-- end /.row -->
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pagination-area">
                            <nav class="navigation pagination" role="navigation">
                                <div class="nav-links">
                                    <a class="prev page-numbers" href="#">
                                        <span class="lnr lnr-arrow-left"></span>
                                    </a>
                                    <a class="page-numbers current" href="#">1</a>
                                    <a class="page-numbers" href="#">2</a>
                                    <a class="page-numbers" href="#">3</a>
                                    <a class="next page-numbers" href="#">
                                        <span class="lnr lnr-arrow-right"></span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </section>
        <!--================================
        END PRODUCTS AREA
    =================================-->




        <!--================================
        START CALL TO ACTION AREA
    =================================-->
        <section class="call-to-action bgimage">
            <div class="bg_image_holder">
                <img src="images/library-438389.jpg" alt="elibrary">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-12">
                        <div class="call-to-wrap">
                            <h1 class="text--white">Rozpocznij swoją scieżkę kariery!</h1>
                            <h4 class="text--white">Dołącz do nas już dziś i rozwiń skrzydła</h4>
                            <a href="register.php" class="btn btn--lg btn--round btn--white callto-action-btn">Zarejestruj</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================================
        END CALL TO ACTION AREA
    =================================-->

        <?php
        require_once('inc/footer.php');
        ?>
</body>

</html>