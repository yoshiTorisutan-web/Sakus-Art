<?php
/* Fonctionnement d'envoi du formulaire et demande reçu dans la boîte mail du propriétaire */
if(isset($_POST['mailform'])) { // Lien avec le bouton d'envoi du formulaire

    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['sujet']) AND !empty($_POST['message'])) { // données remplies dans chaque input du formulaire par l'utilisateur
        // mise en place du système de captcha pour éviter le spam (ex: robot)
        $secret = "6Ld43PAeAAAAAJ8FrvicMDMfviVus86Ewgy1kugP";
        $response = htmlspecialchars($_POST['g-recaptcha-response']);
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";

        $get = file_get_contents($request);
        $decode = json_decode($get, true);
        
        if($decode['success']){ // corps du message reçu sur la boîte mail du propriétaire
            $header="MIME-Version: 1.0\r\n";
            $header.='From:"Sakus\'Art"<contact.sakusart@gmail.com>'."\n";
            $header.='Content-Type:text/html; charset="uft-8"'."\n";
            $header.='Content-Transfer-Encoding: 8bit';
            // on récupère les données que l'utilisateur a inséré dans le formulaire et on les affiche dans le mail
            $message='
            <html>
                <body>
                    <h1 style="font-family: Square Peg, cursive; text-align: center">SAKUS\'ART</h1>
                    <h2 style="font-size: 20px; background-color: green; text-align: center">CONTACT</h2>
                    <div align="center">
                    <u>Prénom de l\'expéditeur :</u> '.$_POST['prenom'].' <br />
                    <u>Nom de l\'expéditeur :</u> '.$_POST['nom'].' <br />
                    <u>Mail de l\'expéditeur :</u> '.$_POST['mail'].' <br />
                    <u>Sujet :</u> '.$_POST['sujet'].' <br />
                    <br />
                    '.nl2br($_POST['message']).'
                    <br />
                    </div>
                </body>
            </html>
            ';
            if(mail("sakusart492022@outlook.fr", "CONTACT - SAKUS\'ART", $message, $header)) {
              // notification pour l'utilisateur que sa demande a été prise en compte et envoyée sur la boîte mail du propriétaire
            $msg='<p style=color:green>Votre message a bien été envoyé ! 📤</p>';   
            }
            else {
                $msg = '<p style=color:red>Erreur dans l\'envoi du message ! ❌</p>'; 
            }
        }
    }
    else { 
        // notification pour l'utilisateur qu'il doit remplir l'ensemble des champs et cocher le captcha pour que sa demande soit envoyé
        $msg='<p style=color:red>Tous les champs doivent être complétés<br>ainsi que le captcha ! ⚠️</p>';      
    }
}
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
            </a>
            <span class="slogan">Apprenons l'art de créer ensemble</span>
            <span class="home">Aide et coordonnées</span>
            <span class="citation">L'art aide à vivre !</span>
            <span class="author">(E-E Schmitt.)</span>
        </div>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
        <p class="navbar-right follow">
            Suivre 
            <br>
            <a href="https://www.instagram.com/art_tristoune_49/" class="fa fa-instagram"></a>
            <a href="https://www.pinterest.fr/ART_Tristoune/_saved/" class="fa fa-pinterest"></a>
        </p>
    </div>
    </div>
</div>
<!-- Contenu -->
<div class="main-content">
    <!-- Formulaire contact auprès du propriétaire du site pour donner un avis sur le site et obtenir ses services -->
    <div class="aide">Une explication personnelle sur un projet ?<br>Des questions ? Besoin d'aide ? <br>N'hésitez pas,
        Sakus'Art est là pour vous aider.<br> Laissez-moi votre message et j'y<br> répondrai dans les plus brefs
        délais.
        <form method="post" action="" id="demo-form">
            <div class="champ">
                <br>
                <input class="prenom" type="text" id="prenom" name="prenom" placeholder="Prénom" maxlength="25"
                    size="30" value="<?php if(isset($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom']); } ?>">
            </div>
            <div class="champ">
                <input class="nom" type="text" id="nom" name="nom" placeholder="Nom" maxlength="25" size="30"
                    value="<?php if(isset($_POST['nom'])) { echo htmlspecialchars($_POST['nom']); } ?>">
            </div>
            <div class="champ">
                <input class="mail" type="text" id="mail" name="mail" placeholder="Adresse mail"
                    pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" maxlength="50" size="30"
                    value="<?php if(isset($_POST['mail'])) { echo htmlspecialchars($_POST['mail']); } ?>">
            </div>
            <div class="champ">
                <input class="sujet" type="text" id="sujet" name="sujet" placeholder="Sujet" maxlength="100" size="30"
                    value="<?php if(isset($_POST['sujet'])) { echo htmlspecialchars($_POST['sujet']); } ?>">
            </div>
            <div class="champ">
                <textarea rows="2" cols="30" class="message" type="message" id="message" name="message"
                    placeholder="Message" maxlength="1000"
                    value="<?php if(isset($_POST['message'])) { echo htmlspecialchars($_POST['message']); } ?>"></textarea>
            </div>
            <!-- reCaptcha Google -->
            <div class="g-recaptcha" data-sitekey="6Ld43PAeAAAAAPir_ZK52N-DzsoeD8jJXrqfDZXP"></div>
            <br>
            <!--bouton d'envoi du formulaire-->
            <div class="champ">
                <input class="send" type="submit" value="Envoyer le message" name="mailform">
            </div>
        </form>
        <!-- Message de confirmation d'envoi du formulaire -->
        <?php if (isset($msg)) {
          echo $msg;
        }
        ?>
    </div>
    <!-- Dessin journal présent au milieu de la page -->
    <img class="journal" alt="journal" src="public/Medias/journal.png">
    <img class="calendrier" alt="calendrier" src="public/Medias/calendrier.png">
    <!-- Coordonnées -->
    <span class="contact"> Coordonnées !
        <br>
        <p class="email">Email: contact.sakusart@gmail.com
    </span>
    <br>
    <p class="siteweb">Site web : https://www.sakusart.fr</span>
        <br>
    <!-- Fil d'actualité  -->    
    <div class="holder">
        <ul id="ticker01">
            <li><u><em>Nos prochaines actualités</em></u></a></li>
            <li><span>31/12/2021</span><br><a href="#">Finalisation de la base HTML du site</a></li>
            <li><span>31/05/2022</span><br><a href="#">Finalisation partie backend du site</a></li>
            <li><span>28/07/2022</span><br><a href="#">Nouvel onglet "Logo"</a></li>
            <li><span>05/07/2022</span><br><a href="#">Présentation du site</a></li>
            <li><span>31/08/2022</span><br><a href="#">Ouverture du site</a></li>
            <li><span>31/10/2022</span><br><a href="#">Evolution du site internet</a></li>
            <li><span>25/03/2023</span><br><a href="#">Mise en place d'une boutique en ligne</a></li>
        </ul>
    </div>
    <a href="index.php?page=eventCalendar"><input class="calendar aCalendar" type="button" value="Calendrier évènements"></a>
</div>
<br>
<br>

<script src='public/CDN/jquery.min.js'></script>
<script src="public/JS/aidescript.js"></script>

<!-- Script pour appeler l'API Google Captcha -->
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
    document.getElementById("demo-form").submit();
    }
</script>