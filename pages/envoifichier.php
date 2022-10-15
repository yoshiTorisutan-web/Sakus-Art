<?php
include('./models/fichier.php');
require('./utils/db.php');

/* Message pour prévenir que le fichier a été envoyé avec succès en BDD et dans le dossier admin */
if (isset($_POST['envoiFichier'])) {
  if (Fichier::upload($_FILES, $_POST, $pdo)) {
    echo "<p class=\"bg-success\">Fichier envoyé avec succès</p>";
  }
}
if (isset($_POST['delete'])) {
  Fichier::deleteFichier($_FILES, $_POST, $pdo);
  echo "<p class=\"bg-danger\">Fichier supprimé</p>";
}
?>

<h1>SAKUS'ART</h1>

<h2>Uploader un fichier PNG ou JPG</h2>

<form action="index.php?page=envoifichier" method="POST" enctype="multipart/form-data">
    <!-- On utilise action pour relié notre fichier php qui contiendra 
            les scripts à executés pour l'envoie de nos fichiers, etant donné
            que l'on charge un fichier on indique enctype multipart/from-data-->
    <label for="intitule"></label>
    <br>
    <input class="import" type="file" name="fichier" />
    <br>
    <input type="text" id="intitule" name="intitule" placeholder="Intitulé" required>
    <span><input type="text" id="date" name="date" placeholder="Date" required></span>
    <br>
    <br>
    <input type="submit" id="send" name="envoiFichier" value="Envoyer le fichier" />
</form>
<br>

<h2>Fichiers PNG ou JPG enregistrés</h2>
<br>


<?php
if (Fichier::download($_FILES, $_POST, $pdo)) {
  //Créer un lien avec le dossier models pour le fichier.php
}
?>

<!-- Bouton de retour à la page principale de l'espace admin -->
<div class="champ">
    <a href="index.php?page=admin"><input class="accueil" type="button" value="Page admin"></a>
</div>