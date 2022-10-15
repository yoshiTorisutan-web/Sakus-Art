<!-- Déconnexion et destruction de la session lorsque l'utilisateur se déconnecte -->
<?php
session_unset();
session_destroy();
header('Location: index.php?page=accueil');
die();
