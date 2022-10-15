<?php
/* Affichage des cookies sur le site */
if (isset($_COOKIE['accept_cookie'])) {
  $showcookie = false;
} else {
  $showcookie = true;
}
if ($showcookie) { ?>
  <div class="cookie-alert">
    En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies pour vous proposer des contenus et services adaptés à vos centres d’intérêts. &nbsp;<img class="logoCookie" alt="image" src="public/Medias/cookie.png" ><br/><a href="donnees/accept_cookie.php">OK</a>
  </div>
<?php }
?>

<style>
  /* Cookies */
.logoCookie
{
    width: 20px;
}
.cookie-alert {
    position: fixed;
    bottom: 45px;
    right:20px;
    border-radius: 10px;
    background-color: black;
    color:white;
    padding:10px 15px;
    width:300px;
    z-index:-1;
  }
  .cookie-alert a {
    display:block;
    text-align: center;
    padding:5px 10px;
    margin:8px auto 0 auto;
    border-radius: 10px;
    background:transparent;
    border: 2px solid #24C5FF;
    color:#24C5FF;
    transition: all .3s ease;
  }
    .cookie-alert a:hover {
       background: white;
       color: black;
    }
  @media only screen and (max-width:480px) {
    .cookie-alert {
       text-align: center;
       left: 0; right: 0;;
       margin: 0 auto;
       max-width:700px;
       padding:10px 30px;
    }
  }
</style>

<!-- Bas de page avec un ensemble de liens -->
<footer class="bg-light text-right text-white">
  <div class="text-right p-3 backgroundFooter">
    <span class="copyright">© 2021 Copyright: Sakus'Art</span>
    <span class="conditions"><a class="aCgu" href="index.php?page=cgu">Conditions générales d'utilisation</span></a>
    <span class="donnéesPerso"><a class="aDonneesPerso" href="index.php?page=donneespersonnelles">Données Personnelles</span></a>
    <span class="mentionsLégales"><a class="aMentionsLegales" href="index.php?page=mentionslegales">Mentions Légales</span></a>
    <span class="cookies"><a class="aCookies" href="index.php?page=cookies">Cookies</span></a>
    <span class="version">V1.0</span>
  </div>
</footer>

</body>

</html>