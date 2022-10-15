<?php
include('./utils/db.php');

if (true) {
    extract($_GET);
    $idOeuvre = $_GET['id'];

    require_once('./models/oeuvrescommentaire.php');

    if (!empty($_POST)) {
        extract($_POST);
        $errors = array();

        $comment = strip_tags($comment);

        if (empty($comment))
            array_push($errors, 'Entrez un commentaire');

        if (count($errors) == 0) {
            $comment = addComment($idOeuvre, $comment);
            $success = "Votre commentaire a bien été publié";

            unset($comment);
        }
    }

    $oeuvre = getOeuvre($idOeuvre);
    $comments = getComments($idOeuvre);
}
?>

<div class="navbar navbar-inverse navbar-global navbar-fixed-top">
    <!-- Conteneur du site -->
    <div class="container-fluid">
        <!-- Haut de page -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"></button>
            <!-- Contenu du haut de page-->
            <a href="index.php?page=accueil">
                <div class="navbar-title">SAKUS'ART
            </a>
            <span class="slogan">Apprenons l'art de créer ensemble</span>
            <span class="create">Espace commentaire</span>
            <span class="discover"><em>Bonne découverte !</em></span>
        </div>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
        <p class="navbar-right follow">
            Suivre Sakus'Art
            <br>
            <a href="https://www.instagram.com/art_tristoune_49/" class="fa fa-instagram"></a>
            <a href="https://www.pinterest.fr/ART_Tristoune/_saved/" class="fa fa-pinterest"></a>
        </p>
    </div>
</div>
</div>
<br><br><br><br><br>
<div class="container-fluid">
    <a href="index.php?page=commentairedessin" class="btn btn-success pull-right">Retour aux oeuvres</a>
    <br><br>
    <?php
    echo ('<img class="dessin" src="' . $oeuvre['IMG_OEUVRES'] . '">');
    ?>
    <br><br>
    <p class="explication"><?php echo $oeuvre['CONTENU_OEUVRES'] ?></p>
    <br>
    <hr>

    <?php
    if (isset($success))
        echo $success;
    if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger"><?= $error ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif;
    ?>

    <h2>Commentaires</h2>
    <br>
    <?php foreach ($comments as $com) : ?>
        <div class="message">
            <p><?php echo $_SESSION['pseudo'] ?></p>
            <time class="timeMessage"><?php echo $com['DATE_COMMENTAIRE'] ?></time>
            <hr>
            <p><?php echo $com['MESSAGE_UTILISATEUR'] ?></p>
        </div>
    <br>
    <?php endforeach; ?>
    <hr>
    <br>

    <div class="row center">
        <div class="col-md-6">
            <form action="index.php?page=avisdessin&id=<?= $oeuvre['ID_OEUVRE'] ?>" method="post">
                <p class="area"><label for="comment">Poster un commentaire</label><br>
                    <textarea name="comment" id="comment" cols="30" rows="5" value="<?php if (isset($comment)) echo $comment ?>" class="form-control" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné."></textarea>
                </p>
                <button type="submit" class="btn btn-success btnCenter">Envoyer</button>
            </form>
        </div>
    </div>
    <br>
</div>