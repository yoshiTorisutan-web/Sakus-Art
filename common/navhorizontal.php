<?php
  ob_start();
?>
<!-- Dashboard -->
<nav class="navbar navbar-inverse navbar-global navbar-fixed-top">
    <!-- Conteneur du site -->
    <div class="container-fluid">
        <!-- Haut de page -->
        <div class="navbar-header">
            <!-- Contenu du haut de page -->
            <a href="index.php?page=accueil">
                <div class="navbar-title">SAKUS'ART
            </a>
            <?php
                if (@$_SESSION["etatConnexion"] == "1"){
                    //Affichage pseudo si connecté
                    echo ('<span class="pseudoConnect">Bonjour&nbsp<strong>'. $_SESSION['pseudo'].  '</strong> !</span>');
                }
                else {
                    //Affichage message "Bienvenue" si pas connecté
                    echo('<span class="welcome">Bienvenue</span>');
                }
            ?>
            <span class="home">Accueil</span>
        </div>
    </div>
    <!-- Bouton icône qui renvoie à la page d'aide -->
    <div id="navbar" class="collapse navbar-collapse">
        <p class="navbar-right help">
            <a class="helpClick">
                Une question ? Suivre l'actualité ?
                <br>
                Contacter Sakus'Art ?
            </a>
        </p>
        <p class="navbar-right help-icon">
            <a href="index.php?page=aide" class="glyphicon glyphicon-question-sign"></a>
        </p>
        <span class="navbar-right verticalBarre"></span>
    </div>
    </div>
</nav>