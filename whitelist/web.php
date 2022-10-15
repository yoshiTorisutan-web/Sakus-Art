<?php
$whitelist = array('connexion', 'authentif', 'inscription', 'register', 'viderSession', 'profilUtilisateur', 'forum', 'accueil', 'art', 'artgraphique', 'logo', 'preview', 'aide', 'preview', 'mdp1', 'mdp2', 'commentairedessin', 'commentairephoto', 'avisdessin', 'avisphoto', 'id', 'envoifichier', 'files', 'Admin', 'game', 'cgu', 'cookies', 'donneespersonnelles', 'mentionslegales', 'accesinterdit', 'utilisateur', 'fichier', 'error404', 'admin', 'eventCalendar', 'pwdForget');
if (isset($_SESSION["etatConnexion"]) && $_SESSION["etatConnexion"] == 1) {
    //la connexion a été établie
    array_push($whitelist, 'accueil', 'deconnexion');
}
//déclarer des accès specifique admin