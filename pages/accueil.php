<!-- Page de transition avant d'entrer sur la page d'accueil -->
<body>
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <!-- Contenu -->
    <div class="main-content">
        <!-- Bannière image ours -->
        <img class="bear" src="public/Medias/Bear_and_forest.png" alt="image">
        <!-- Texte sur la bannière -->
        <div class="textIntro">Apprenons l'art de<br> créer ensemble.<br><br><br>Le meilleur de l'art créatif <br>et de
            l'art graphique à<br> portée de main.</div>
        <!-- Signature de l'artiste -->
        <div class="signature">By Tristan Bossard</div>
        <!-- Portrait de l'artiste -->
        <img class="portrait" alt="portrait" src="public/Medias/Double_face.jpg">
        <!-- Texte biographie -->
        <span class="biographie">
            L'artiste Tristan Bossard débute sa carrière de créateur en tout genre en juin 2013, âgé de 15 ans,
            <br>
            à cette époque là, il décida de créer son propre monde artistique.
            <br>
            <br>
            En 2021, il lança Sakus'Art, un site d'entraide pour particulier et artistes afin de partager ses
            <br>
            créations (peinture,dessin, photographie, audiovisuel, etc.) et/ou de partager ses astuces.
            <br>
            <br>
            "Etant passionné par l'automobile ainsi que la création graphique ou la création sur papier,
            <br>
            j'ai voulu créer mon propre univers et ainsi créer ce site internet pour dévoiler toutes mes astuces
            <br>
            pour réaliser une oeuvre de manière simple. Par ce site, je vous partagerai toutes
            <br>
            mes créations et également répondre à l'ensemble de vos problématiques et questionnements."
            <br>
            <br>
            <u>Thèmes</u> : Automobile / Animé / Logo / Néon / Synthwave / Animal / Histoire / Engagement
        </span>
        <!-- Plaque artiste -->
        <p class="sousTitre">
            <u>Portrait de l'artiste</u>
            <br>
            Tristan <strong>BOSSARD</strong>
            <br>
            11/11/2021
        </p>
        <!-- Message de bienvenue aux utilisateurs -->
        <span class="citation">
            "On ne peut pas dire d'une oeuvre d'art qu'elle soit inutile; [...] <br> elle est un moyen de communication entre
            celui qui l'a crée et celui qui l'admire; <br> elle répond donc au besoin humain le plus spécifique : mettre en
            commun." <br><br> <em>(Albert Jacquard)</em>
        </span>
        <!-- Bouton Mini-Jeu -->
        <a class="ExplicationMJ" href="index.php?page=game" title="Amuse toi avec ce mini-jeu sur les oeuvres !" target="_blank"><strong><input class="game mini-jeu" type="button" value="Mini-jeu"></strong></a>
    </div>

    <script src='public/CDN/jquery.min.js'></script>
    <script src="public/JS/transitionpage.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
        /* Popup Jquery UI */
        $(function() {
            $('.ExplicationMJ').tooltip({
                position: {
                    my: "left-60 bottom+70",
                    at: "bottom"
                }
            });
        });
    </script>

    <script>
        document.oncontextmenu = function() {
            return false;
        }
    </script>

</body>

</html>