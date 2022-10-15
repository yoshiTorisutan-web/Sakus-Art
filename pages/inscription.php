<?php
//enregistrement en BD du nouvel utilisateur
//chargement des paramètres de la BD
include('./utils/db.php');
include('./models/utilisateur.php');

/* Création du compte utilisateur */
if (isset($_POST['register-submit'])) {
    Utilisateur::create($pdo, $_POST);
}
/* Vérification du pseudo identique ou non afin d'éviter les doublons */
if (isset($_POST['pseudo'])) {
    Utilisateur::SamePwd($pdo, $_POST);
}
/* Vérification du mail identique ou non afin d'éviter les doublons */
if (isset($_POST['mail'])) {
    Utilisateur::SameMail($pdo, $_POST);
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
            <span class="create">Création de compte</span>
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

<!-- Contenu -->
<div class="main-content">
    <div class="aide">
        <span class="title">SAKUS'ART</span>
        <br>
        <span class="titlebis">Création de compte</span>
        <!-- Formulaire de création de compte -->
        <form action="index.php?page=inscription" method="post" role="form">
            <div class="champ">
                <br>
                <input class="prenom" type="text" id="prenom" name="prenom" size="30" maxlength="25" placeholder="Prénom" required>
            </div>
            <div class="champ">
                <input class="nom" type="text" id="nom" name="nom" size="30" maxlength="25" placeholder="Nom" required>
            </div>
            <div class="champ">
                <input class="pseudo" type="text" id="pseudo" name="pseudo" size="30" maxlength="25" placeholder="Pseudo" required>
                <?php
                if (isset($_POST['pseudo'])) {
                    echo ('<p style=color:red>❌ Pseudo déjà existant</p>');
                } else {
                    // pseudo disponible
                } 
                ?>
            </div>
            <div class="champ">
                <input class="mail" type="text" required maxlength="50" pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" id="mail"
                    name="mail" size="30" placeholder="Adresse mail">
                    <?php
                if (isset($_POST['mail'])) {
                    echo ('<p style=color:red>❌ Mail déjà existant</p>');
                } else {
                    // mail disponible
                } 
                ?>
            </div>
            <div class="champ form-group d-flex">
                <input type="password" required name="motdepasse" id="motdepasse" size="30" maxlength="25" class="motdepasse"
                    placeholder="Mot de passe" onchange="controlPwd(this)">
                <i class="bi bi-eye-slash" id="toggleMotDePasse"></i>
            </div>
            <div class="champ form-group d-flex">
                <input type="password" name="confirm-motdepasse" maxlength="25" size="30" onchange="confirmPwd()" id="confirm-motdepasse"
                    tabindex="2" class="motdepasse" placeholder="Confirmer mot de passe" required>
                <i class="bi bi-eye-slash" id="toggleMotDePasse"></i>
            </div>
            <!-- Bouton d'envoi du formulaire -->
            <div class="champ">
                <input class="send" type="submit" name="register-submit" value="Créer un compte">
            </div>
            <!-- Lien pour s'authentifier si compte déjà créé -->
            <div class="account">
                Déjà membre ?<a href="index.php?page=authentif"> <u>Se connecter</u></a>
            </div>
        </form>
    </div>
</div>

<!-- Script pour fonctionnement de l'oeil mot de passe visible ou non -->
<script>
/* Possibilité de rendre visible le mot de passe avec l'oeil */    
const togglePassword = document.querySelector("#toggleMotDePasse");
const password = document.querySelector("#motdepasse");

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
    const pwd = document.getElementById('motdepasse');
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