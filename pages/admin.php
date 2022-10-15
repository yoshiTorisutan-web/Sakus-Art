<!-- Page admin réservé uniquement à l'administrateur pouvant accéder aux différentes pages comme la plateforme de transfert d'oeuvre
et l'espace modération pour l'espace commentaire -->
<?php
if (!empty($_SESSION["statut_utilisateur"] == "Admin"))
{
// Contenu de la page
  echo('<div class="main-content">
    <div class="admin">
        <span class="title">SAKUS\'ART</span>
        <br>
        <span class="titlebis">Espace Admin</span>
        <div class="champ">
            <a href="index.php?page=envoifichier" target="_blank"><input class="oeuvres" type="button" value="Téléchargement oeuvres"></a>
        </div>
        <div class="champ">
            <a href="" target="_blank"><input class="commentaire" type="button" value="Administrateur commentaires"></a>
        </div>
        <div class="champ">
            <a href="index.php?page=accueil"><input class="accueil" type="button" value="Retour à l\'accueil"></a>
        </div>
        <img class="logo" src="public/Medias/LOGO OFFICIEL TRISTAN (Transparent).png">
    </div>
</div>');
}
else
{
//redirection via header();  
  header('Location: index.php?page=accesinterdit');
}
?>
