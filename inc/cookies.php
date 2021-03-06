<link rel="stylesheet" href="css/cookies.css">

<div id="cookieNotice" class="light display-right">
    <div class="title-wrap">
        <h4>Cookies</h4>
    </div>
    <div class="content-wrap">
        <div class="msg-wrap">
            <p>Ta strona korzysta z plików cookies lub podobnych technologii, aby poprawić komfort przeglądania i zapewnić spersonalizowane rekomendacje. Kontynuując korzystanie z naszej strony internetowej, wyrażasz zgodę na naszą <a href="privacy-policy.php">Politykę Prywatności</a>.</p>
            <div class="btn-wrap">
                <button class="btn-primary" onclick="acceptCookieConsent();">Akceptuj</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let cookiesAccepted = sessionStorage.getItem('cookiesAccepted');
    if (cookiesAccepted == "yes") {
        console.log('cookies are accepted');
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }

    function acceptCookieConsent() {
        document.getElementById("cookieNotice").style.display = "none";
        sessionStorage.setItem('cookiesAccepted', 'yes');
    }
</script>