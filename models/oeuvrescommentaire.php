<?php
/* Fonction qui récupère tous les dessins */
function getDrawsComments($pdo)
{
    $stmt = $pdo->prepare("SELECT ID_OEUVRE, TITRE_OEUVRE, DATE_CREATION_EC FROM oeuvres WHERE ID_TYPES_OEUVRES = 1 ORDER BY ID_OEUVRE ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/* Fonction qui récupère tous les art graphique */
function getPhotosComments($pdo)
{
    $stmt = $pdo->prepare("SELECT ID_OEUVRE, TITRE_OEUVRE, DATE_CREATION_EC FROM oeuvres WHERE ID_TYPES_OEUVRES = 2 ORDER BY ID_OEUVRE ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/* Fonction qui récupère une oeuvre */
function getOeuvre($idOeuvre)
{
    require('./utils/db.php');
    $stmt = $pdo->prepare("SELECT * FROM oeuvres WHERE ID_OEUVRE = ?");
    $stmt->execute(array($idOeuvre));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
/* Fonction qui ajoute un commentaire en BDD */
function addComment($idOeuvre, $comment)
{
    require('./utils/db.php');
    $stmt = $pdo->prepare("INSERT INTO interagir (ID_OEUVRE, MESSAGE_UTILISATEUR, DATE_COMMENTAIRE) VALUES (?,?, NOW())");
    $stmt->execute([$idOeuvre, $comment]);
}
/* Fonction qui récupère les commentaires d'un article */
function getComments($idOeuvre)
{
    require('./utils/db.php');
    $stmt = $pdo->prepare("SELECT * FROM interagir WHERE ID_OEUVRE = ?");
    $stmt->execute(array($idOeuvre));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}