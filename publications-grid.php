<?php
require_once 'inc/head.php';
require_once 'inc/navbar.php';
require_once "inc/publication-scripts.php";

if (!isset($_SESSION)) {
    session_start();
}
// Get all publications of chosen user based on their ID, if ID is not given, use ID from session. 
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$publications = get_publications($db, $user_id);
?>

<body class="preload home3">
    <!--================================
        START SEARCH AREA
    =================================-->
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
    <section class="products" id="products">
        <!-- start container -->
        <div class="container">
            <!-- start .row -->
            <div class="row">
                <?php foreach ($publications as $publication) : ?>
                    <!-- start .col-md-4 -->
                    <div class='col-lg-4 col-md-6'>
                        <!-- start .single-product -->
                        <div class='product product--card'>
                            <div class='product__thumbnail'>
                                <img src='<?= $publication['cover_path'] ?>' style="height:185px;" alt='Product Image'>
                                <div class='prod_btn'>
                                    <a href="publication.php?publication_id=<? $publication['publication_id'] ?>" class='transparent btn--sm btn--round'>Czytaj dalej</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class='product-desc'>
                                <a href='publication.php?publication_id=<?= $publication['publication_id'] ?>' class='product_title'>
                                    <h4><?= $publication['title'] ?></h4>
                                </a>
                                <ul class='titlebtm'>
                                    <a href="user-profile.php?user_id=<?= $publication['user_id'] ?>">

                                        <li>
                                            <img class='auth-img' src='<?= $publication['profile_image'] ?>' alt='author image'>
                                            <p>
                                                <?= $publication['first_name'] ?> <?= $publication['surname'] ?>
                                            </p>
                                        </li>
                                    </a>
                                    <li class='product_cat'>
                                        <a href='publications-grid.php'>
                                            <span class='lnr lnr-book'></span><?= $publication['category'] ?></a>
                                    </li>
                                </ul>

                                <p><?= $publication['abstract'] ?></p>
                            </div>
                            <!-- end /.product-desc -->

                            <div class='product-purchase'>
                                <div class='price_love'>
                                    <p>
                                        <span class='lnr lnr-heart'></span> <?= $publication['rating'] ?>
                                    </p>

                                </div>

                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                        <!-- end /.single-product -->
                    </div>
                    <!-- end /.col-md-4 -->
                <?php endforeach; ?>
            </div>
            <!-- end /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area">
                        <nav class="navigation pagination" role="navigation">
                            <div class="nav-links">
                                <a class="prev page-numbers" href="publications-grid.php">
                                    <span class="lnr lnr-arrow-left"></span>
                                </a>

                                <?php
                                /*
                                $page_number = ceil(($get_solutions->rowCount) / 9);

                                for ($x = 1; $x < $page_number + 1; $x++) {
                                    if (@($_GET['Page']) == $x) {

                                        echo ("<a class='page-numbers current' href='$_SERVER[REQUEST_URI]'>$x</a>");
                                        // echo("<li class='page-item active'><a href='$_SERVER[REQUEST_URI]' class='page-link'>$x</a></li>");
                                    } else {
                                        echo ("<a class='page-numbers' href='publications-grid.php?Page=$x'>$x</a>");
                                    }
                                }
                                echo "<a class='next page-numbers' href='publications-grid.php?Page=$page_number'>
                                    <span class='lnr lnr-arrow-right'></span>
                                </a>";
                                */
                                ?>
                                <!-- <a class="page-numbers current" href="#">1</a>
                                <a class="page-numbers" href="#">2</a>
                                <a class="page-numbers" href="#">3</a> -->

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