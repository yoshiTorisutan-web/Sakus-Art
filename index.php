<?php
include('utils/db.php');
// accessibilité à la session courante de l'utilisateur
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : "preview";
// Affichage « de la partie haute » de votre site, commun à l'ensemble de votre site
include('./common/header.php');
// Pages autorisées : whitelist
include('./whitelist/web.php');
// Pages sans navigation à gauche
if ($page != 'preview' && $page != 'inscription' && $page != 'authentif' && $page != 'commentairedessin' && $page != 'commentairephoto' && $page != 'avisdessin' && $page != 'avisphoto' && $page != 'forum' && $page != 'mdp1' && $page != 'mdp2' && $page != 'envoifichier' && $page != 'admin' && $page != 'game' && $page != 'profilUtilisateur' && $page != 'accesinterdit' && $page != 'error404' && $page != 'eventCalendar' && $page != 'pwdForget') {
    //nav commune à tout le site
    include('./common/navlateral.php');
    include('./common/navhorizontal.php');
}
// Gestion de l'affichage de la page demandée
//limiter le temps de la session
$timeSession = isset($_SESSION['timeLastAction']) ? $_SESSION['timeLastAction'] : time();
$timeCourant = time(); //nb s depuis le 01/01/70

if (
    //$timeCourant - $timeSession < 300 &&//300 s = 5 min
    in_array($page, $whitelist) //accès à la page autorisée
) {
    //rafraichissement du temps de la dernière action
    $_SESSION['timeLastAction'] = $timeCourant;
    if ($page == "authentif") {
       session_regenerate_id();
    }
    include("pages/" . $page . '.php');
} else {
    //si le champ page n'est pas accessible dans l'URL OU que l'accès à la page n'est pas possible
    //alors on demande une authentification

    //si le temps d'inactivité a été dépassé, détruire la session
    //et forcer une ré authentification
    if ($timeCourant - $timeSession >= 300) {
        session_destroy();
        session_start();
     }
    session_regenerate_id();

    include('pages/authentif.php');
};

// Non-affichage de la partie basse de votre site pour certaines pages
if ($page != 'preview' && $page != 'inscription' && $page != 'authentif' && $page != 'commentairedessin' && $page != 'commentairephoto' && $page != 'avisdessin' && $page != 'avisphoto' && $page != 'forum' && $page != 'mdp1' && $page != 'mdp2' && $page != 'envoifichier' && $page != 'admin' && $page != 'game' && $page != 'profilUtilisateur' && $page != 'accesinterdit' && $page != 'error404' && $page != 'eventCalendar' && $page != 'pwdForget')
// Affichage de la partie basse de votre site, commun à l'ensemble de votre site. 
include('./common/footer.php');












