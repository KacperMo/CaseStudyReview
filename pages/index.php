<?php
require_once('components/head.php');
require_once('components/navibar.php')
?>

<body class="preload home1 mutlti-vendor">
    <section class="hero-area bgimage" style="z-index:-1;">
        <div class="bg_image_holder" style="z-index:-2;">
            <img src="images/library-869061.jpg" alt="background-image">
        </div>
        <div class="hero-content content_above">
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero__content__title">
                                <h1>
                                    <span class="bold">Case Study Review</span>
                                </h1>
                                <p class="tagline">Internetowa baza wiedzy</p>
                            </div>
                            <div class="hero__btn-area">
                                <a href="publications-grid.php" class="btn btn--round btn--lg">Zobacz Opracowania</a>
                                <a href="addsolution.php" class="btn btn--round btn--lg">Dodaj Publikacje</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="search_box">
                            <form action="publications-grid.php">
                                <input type="text" class="text_field" placeholder="Szukaj publikacji">
                                <div class="search__select select-wrap">
                                    <select name="category" class="select--field" id="blah">
                                        <option value="">Wszystkie </option>
                                        <option value="">Statystyka</option>
                                        <option value="">IT</option>
                                        <option value="">Zarządzanie</option>
                                        <option value="">Ekonomia</option>
                                        <option value="">Mechanika</option>
                                        <option value="">Handel</option>
                                        <option value="">HR</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                                <button type="submit" class="search-btn btn--lg">Szukaj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature">
                        <div class="feature__img">
                            <img src="images/svg/handshake.png" width="113px" alt="partner">
                        </div>
                        <div class="feature__title">
                            <h3>Znajdź wymarzonego partnera w biznesie.</h3>
                        </div>
                        <div class="feature__desc">
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature">
                        <div class="feature__img">
                            <img src="images/svg/rocket.png" width="113px" alt="rocket">
                        </div>
                        <div class="feature__title">
                            <h3>Przeszukuj Innowacyjne Publikacjie</h3>
                        </div>
                        <div class="feature__desc">
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature">
                        <div class="feature__img">
                            <img src="images/svg/growth.png" width="113px" alt="partner">
                        </div>
                        <div class="feature__title">
                            <h3>Rozwijaj Się i Twórz</h3>
                        </div>
                        <div class="feature__desc">
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="proposal-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 no-padding">
                    <div class="proposal proposal--left bgimage">
                        <div class="bg_image_holder" style="background-image: url(&quot;images/bbg.png&quot;); opacity: 1;">
                            <img src="images/bbg.png" alt="images/bbg.png">
                        </div>
                        <div class="content_above">
                            <div class="proposal__icon ">
                                <img src="images/svg/search.png" width="100px" alt="create">
                            </div>
                            <div class="proposal__content ">
                                <h1 class="text--white">Twórz I Pozwól Się Odkyć</h1>
                                <p class="text--white">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diamcongue is laoreet elit metus.</p>
                            </div>
                            <a href="register.php" class="btn--round btn btn--lg btn--white">Zarejestruj I Publikuj</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-padding">
                    <div class="proposal proposal--right">
                        <div class="bg_image_holder" style="background-image: url(&quot;images/sbg.png&quot;); opacity: 1;">
                            <img src="images/sbg.png" alt="images/sbg.png">
                        </div>
                        <div class="content_above">
                            <div class="proposal__icon">
                                <img src="images/svg/discovery.png" width="100px" alt="create">
                            </div>
                            <div class="proposal__content ">
                                <h1 class="text--white">Znajdź Czystą Inspirację</h1>
                                <p class="text--white">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diamcongue is laoreet elit metus.</p>
                            </div>
                            <a href="publications-grid.php" class="btn--round btn btn--lg btn--white">Szukaj Inspiracji</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once('components/footer.php');
    ?>
</body>

</html>