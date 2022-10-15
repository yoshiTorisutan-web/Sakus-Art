<?php
//enregistrement en BD du nouvel utilisateur
//chargement des paramètres de la BD
include('./utils/db.php');
include('./models/oeuvres.php');
?>

<!-- Dashboard -->
<div class="navbar navbar-inverse navbar-global navbar-fixed-top">
    <!-- Conteneur du site -->
    <div class="container-fluid">
        <!-- Haut de page -->
        <div class="navbar-header">
            <!-- Contenu du haut de page -->
            <a href="index.php?page=accueil">
                <div class="navbar-title">SAKUS'ART
            </a><span class="discover">Découverte des oeuvres en tout genre !</span><span class="home">Art</span>
        </div>
    </div>
    <!-- Bouton icône qui renvoie à la page d'aide -->
    <div id="navbar" class="collapse navbar-collapse">
        <p class="navbar-right help">
            <a class="helpClick">
                Une question ? Besoin d'aide ?
                <br>
                Suivre l'actualité ?
            </a>
        </p>
        <p class="navbar-right help-icon">
            <a href="index.php?page=aide" class="glyphicon glyphicon-question-sign"></a>
        </p>
        <span class="navbar-right verticalBarre"></span>
    </div>
</div>
</div>
<!-- Contenu -->
<div class="main-content">
    <!-- Bannière image ours -->
    <img class="space" src="./public/Medias/space official_ps.jpg" alt="image">
    <!-- Gallerie avec toutes les oeuvres d'art -->
    <div class="container-gallery">
        <?php
        $drawings = Oeuvres::getDrawing($pdo);
        $compteur = 0;
        foreach ($drawings as $draw) {
            if ($compteur == 1) {
                echo ('<div class="row">');
            }
            $idOeuvre = $draw['ID_OEUVRE'];
            $techniques = Oeuvres::getTechnique($pdo, $idOeuvre);
            $techniquesSt = "";
            foreach ($techniques as $technique) {
                $techniquesSt .= $technique['LIBELLE_TECHNIQUE'] . " ";
            }
            //$json = json_encode($techniques);

            echo ('
            <div class="col-sm-6 col-md-4 col-lg-3">
                <figure>
                    <img class="myImages dessin" id="myImg" style="cursor:pointer" src="' . $draw['IMG_OEUVRES'] . '">
                    <figcaption>
                        <p class="description">
                            <strong>' . $draw['TITRE_OEUVRE'] . '</strong>, <br> ' . $draw['ANNEE_OEUVRE'] . '
                            <br>
                            ' . $techniquesSt .
                '<br>
                            21 x 29,7 (A4)
                            <br>
                        </p>
                    </figcaption>
                </figure>
            </div>');
            if ($compteur == 4) {
                echo ('</div>');
                $compteur++;
            }
        }
        ?>
    </div>

    <!-- Accès à l'espace commentaire des oeuvres -->
    <div class="comment">
        <a href="index.php?page=commentairedessin" target="_blank">
            <p class="commenText">Espace Commentaire</p>
            <div class="commenTwo">
                <p class="commenText2 glyphicon glyphicon-comment"></p>
            </div>
        </a>
    </div>
    <!-- Script pour rendre les oeuvres dynamiques quand on clique dessus -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" alt="modal" id="img01">
        <div id="caption"></div>
    </div>

    <script>
        document.oncontextmenu = function() {
            return false;
        }
    </script>

    <script src="public/JS/oeuvrescript.js"></script>