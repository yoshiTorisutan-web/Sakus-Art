<!-- Espace mini jeux avec popup de fin de partie -->
<div class="wrap">
	<div class="game"></div>

	<div class="modal-overlay">
		<div class="modal">
			<h2 class="winner">Bien Joué !</h2>
			<button class="restart">Recommencer ?</button>
			<p class="message"><strong>Developpé par SAKUS'ART</strong></a></p>
			<p class="message">Tu es donc très visuel, un bon atout pour un artiste.</a></p>
			<button class="return"><a href="index.php?page=accueil">Retour à l'accueil ?</button>
		</div>
	</div>
</div>
<!-- Message expliquant les règles du jeu -->
<footer>
	<p class="disclaimer"><strong>Jeu du Memory : Trouve les paires de cartes indentiques en les retournant 2 par 2.</strong></p>
</footer>

<script>
	document.oncontextmenu = function() {
		return false;
	}
</script>

<script src='public/CDN/jquery.min.js'></script>
<script src="public/JS/gamescript.js"></script>

