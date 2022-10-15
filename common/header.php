<!DOCTYPE html>
<html lang="en">

<head>
  <title>ASakus'Art | Apprenons l'art ensemble</title>
  <!-- Appel de Bootstrap -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <!-- <link rel='stylesheet' href="public/CDN/bootstrap.min.css"> -->

  <!-- Police Titre -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&family=Reenie+Beanie&display=swap" rel="stylesheet">

  <!-- Police bienvenue -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi&display=swap" rel="stylesheet">

  <!-- Logo Favicon -->
  <link rel="icon" href="public/Medias/circlefavicon.png">

  <!-- Réseaux sociaux -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

  <!-- Transition Page -->
  <link rel="stylesheet" href="public/CDN/normalize.min.css">
  <link rel="stylesheet" href="public/CSS/transitionpage.css">

  <!-- Icône affichage oeil mot de passe -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <!-- <link rel='stylesheet' href="public/CDN/bootstrap-icons.css"> -->

  <!-- Mini-Jeu -->
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Anton'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

  <!-- Jquery UI (popup) -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <!-- Full Calendar JS -->
  <link rel="stylesheet" href="./fullcalendar/main.css">
  <script src="./fullcalendar/main.js" defer></script>

  <?php
  // Relis l'ensemble de mes CSS sur chacune de mes pages .php avec navigation 
  include('./public/CSS/gestioncss.php');
  echo '<link rel="stylesheet" href="public/CSS/' . $hover[$page] . '.css">';
  ?>
</head>

<body>