<?php
require_once 'inc/navbar.php';
require_once 'inc/head.php';
?>
<html>
<head>
    <script type="text/javascript" src="js/cookies.js"></script>
    <link rel="stylesheet" href="css/cookies.css">
</head>
<body>

<div id="cookieNotice" class="light display-right">
    <div class="title-wrap">
        <h4>Cookies</h4>
    </div>
    <div class="content-wrap">
        <div class="msg-wrap">
            <p>Ta strona korzysta z plików cookies lub podobnych technologii, aby poprawić komfort przeglądania i zapewnić spersonalizowane rekomendacje. Kontynuując korzystanie z naszej strony internetowej, wyrażasz zgodę na naszą  <a style="color:#115cfa;" href="privace-policy.php">Politykę Prywatności</a>.</p>
            <div class="btn-wrap">
                <button class="btn-primary" onclick="acceptCookieConsent();">Akceptuj</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>