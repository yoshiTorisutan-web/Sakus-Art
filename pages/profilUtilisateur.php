<?php
ob_start();
include('./models/utilisateur.php');
include('./utils/db.php');

if (!isset($_SESSION['pseudo'])) {
    header('Location: index.php?page=authentif');
} else {
    $pseudo = $_SESSION['pseudo'];
}
?>
<!-- Dashboard -->
<div class="navbar navbar-inverse navbar-global navbar-fixed-top">
    <!-- Conteneur du site -->
    <div class="container-fluid">
        <!-- Haut de page -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Contenu du haut de page-->
            <a href="index.php?page=accueil">
                <div class="navbar-title">SAKUS'ART
            </a>
            <span class="slogan">Apprenons l'art de créer ensemble</span>
            <span class="create">Votre Profil</span>
            <span class="discover"><em>Bonne découverte !</em></span>
        </div>
    </div>
    <!-- Boutons icônes qui renvoie à la page d'Instagram et Pinterest de l'artiste -->
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
<div class="main-content">
    <!-- Affichage du profil de l'utilisateur avec les données de sa connexion au site -->
    <div class="profil">
        <img class="avatar" alt="avatar" src="public/Medias/avatar_icon.png">
        <br><br>
        <span class="titlebis1"><strong><u>Profil</u></strong></span>
        <br><br>
        <div align="center">

            <?php 
            if (!empty($_SESSION["statut_utilisateur"] == "Admin")){
                echo '<strong style="color: red;">Admin</strong>';
            }
            else {
                echo '<strong style="color: green;">Membre</strong>';
            } 
            ?>
            <br><br>
            <strong>Pseudo :</strong>
            <?php echo $_SESSION["pseudo"]; ?>
            <br><br>
            <strong>Prénom :</strong>
            <?php echo $_SESSION["prenom"]; ?>
            <br><br>
            <strong>Nom :</strong>
            <?php echo $_SESSION["nom"]; ?>
            <br><br>
            <strong>Mail :</strong>
            <?php echo $_SESSION["mail"]; ?>
        </div>
        <br>
        <!-- Bouton popup modification profil -->
        <a href="#openModalProfil"><input class="modif aModif" type="button" value="Modifier le profil"></a>
        <br><br>
        <a href="#openModalPwd"><input class="modifPwd aModif" type="button" value="Modifier le mot de passe"></a>
        <br><br>
        <a href="index.php?page=accueil"><input class="accueil aAccueil" type="button" value="Retour à l'accueil"></a>
        <br><br>
        <?php
            if (isset($_POST['register-login'])) {
                Utilisateur::update($pdo, $_POST);
            }
            if (isset($_GET['confirmLogin'])) {
                echo ('<p style=color:green>Votre profil a été modifié avec succès ! 🎉</p>');
            }

            if (isset($_POST['register-pwd'])) {
                Utilisateur::ModifPwd($pdo, $_POST);
            }
            if (isset($_GET['confirmPwd'])) {
                echo ('<p style=color:green>Votre mot de Passe a été modifié avec succès ! 🎉</p>');
            }
            
        ?>
    </div>
    <!-- Popup qui s'affiche pour la modification du profil -->
    <div id="openModalProfil" class="modalProfil">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h1 class="titlebis2">Modification profil utilisateur</h1>
            <form id="register-form" action="index.php?page=profilUtilisateur&confirmLogin=ok" method="post" role="form">
                <div class="champ pseudo">
                    <input type="text" name="pseudo" id="pseudo" tabindex="1" class="form-control" placeholder="Pseudo"
                        value="<?php if (isset($_SESSION['pseudo'])) {echo $_SESSION['pseudo'];} ?>">
                </div>
                <div class="champ prenom">
                    <input type="text" name="prenom" id="prenom" tabindex="1" class="form-control" placeholder="Prénom"
                        value="<?php if (isset($_SESSION['prenom'])) {echo $_SESSION['prenom'];} ?>">
                </div>
                <div class="champ nom">
                    <input type="text" name="nom" id="nom" tabindex="1" class="form-control" placeholder="Nom"
                        value="<?php if (isset($_SESSION['nom'])) {echo $_SESSION['nom'];} ?>">
                </div>
                <div class="champ mail">
                    <input type="email" name="mail" id="mail" tabindex="1" class="form-control" placeholder="Mail"
                        value="<?php if (isset($_SESSION['mail'])) {echo $_SESSION['mail'];} ?>">
                </div>
                <div class="champ">
                    <br>
                    <div class="champ">
                        <input class="send" type="submit" name="register-login" id="register-login" tabindex="4"
                            class="form-control btn btn-secondary" value="Mettre à jour">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Popup qui s'affiche pour la modification du Mot de passe -->
    <div id="openModalPwd" class="modalPwd">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h1 class="titlebis2">Modification Mot de passe</h1>
            <form id="register-form" action="index.php?page=profilUtilisateur&confirmPwd=ok" method="post" role="form">
                <div class="champ">
                    <input type="password" name="new-motdepasse" id="new-motdepasse" size="30" maxlength="25" class="motdepasse"
                        placeholder="Nouveau Mot de passe" onchange="controlPwd(this)">
                        <i class="bi bi-eye-slash" id="toggleMotDePasse"></i>
                </div>
                <div class="champ">
                    <input type="password" name="confirm-motdepasse" id="confirm-motdepasse"
                    size="30" maxlength="25"class="motdepasse" placeholder="Confirmer mot de passe" onchange="confirmPwd(this)">
                        <i class="bi bi-eye-slash" id="toggleMotDePasse"></i>
                </div>
                <div class="champ">
                    <br>
                    <div class="champ">
                        <input class="send" type="submit" name="register-pwd" id="register-pwd" tabindex="4"
                            class="form-control btn btn-secondary" value="Mettre à jour">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- Fermeture de la popup de modification de profil -->
<a href="#close" title="Close" class="close">x</a>
</div>
</div>

<!-- Script pour fonctionnement de l'oeil mot de passe visible ou non -->
<script>
/* Possibilité de rendre visible le mot de passe avec l'oeil */    
const togglePassword = document.querySelector("#toggleMotDePasse");
const password = document.querySelector("#new-motdepasse");

togglePassword.addEventListener("click", function() {
    // Lier les input
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // Icône oeil
    this.classList.toggle("bi-eye");
});

// Lier avec le formulaire d'envoi
const form = document.querySelector("form");
form.addEventListener('submit');
</script>

<script>

/* Fonction pour confirmation du mot de passe pour qu'il soit identique */  
function confirmPwd() {
    const pwd = document.getElementById('new-motdepasse');
    const pwdConfirm = document.getElementById('confirm-motdepasse');
    if (pwd.value != pwdConfirm.value) {
        pwdConfirm.validity.valid = "false";
        pwdConfirm.setCustomValidity("Saisir le même mot de passe");
    } else {
        pwdConfirm.validity.valid = "true";
        pwdConfirm.setCustomValidity("");
    }
}

/* Contrôle de mot de passe respectant différents paramètres : nb de caractères, caractères spéciaux, chiffres, majuscules, etc. */
function controlPwd(elemPwd) {
    const pwd = String(elemPwd.value);
    if (!pwd.match(/[0-9]/g) || !pwd.match(/[A-Z]/g) || !pwd.match(/[a-z]/g) || !pwd.match(/[^a-zA-Z\d]/g) || pwd
        .length < 8) {
        //mot de passe invalide
        elemPwd.validity.valid = "false";
        //info bulle sur le type d'erreur
        elemPwd.setCustomValidity(
            "Votre mot de passe doit comporter au moins 12 caractères avec au moins une majuscule, minuscule, chiffre et signe de ponctuation"
            );
    } else {
        //nettoyage de l'invalidité de la zone
        elemPwd.validity.valid = "true";
        elemPwd.setCustomValidity("");
    }
}
</script>