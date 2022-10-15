<?php
//vérification de l'existance de l'identifiant et du mot de passe.
//chargement des paramètres de la BD et connexion
include('./utils/db.php');

$pseudo = htmlspecialchars($_POST['pseudo']);
$pwd = $_POST['motdepasse'];
//réinitialisation du nb de tentatives
unset($_SESSION["timeNextTentative"]);

$stmt = $pdo->prepare("SELECT ID_UTILISATEUR, NOM_UTILISATEUR, PRENOM_UTILISATEUR, PSEUDO_UTILISATEUR, ADRESSE_MAIL_UTILISATEUR, MOT_DE_PASSE_UTILISATEUR, STATUT_UTILISATEUR, NBCONNEXION_UTILISATEUR, DATE_CONNEXION_UTILISATEUR FROM utilisateurs WHERE PSEUDO_UTILISATEUR=?");
$stmt->execute([$pseudo]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    //il y a un résultat donc l'utilisateur existe, maintenant vérification du mot de passe
    $pwdHashBD = $result['MOT_DE_PASSE_UTILISATEUR'];

    //récupération des données permettant de lutter contre les attaques
    // de force brute
    $nbConnexionFailed = $result['NBCONNEXION_UTILISATEUR'];
    $dateConnexionFailed = $result['DATE_CONNEXION_UTILISATEUR'];
    $delaisAttente = 350;
    $timeCourant = time();
    $timeBD;

    is_null($dateConnexionFailed) ? $timeBD = time() : $timeBD = strtotime(date($dateConnexionFailed));
    
    if ($nbConnexionFailed > 3 && $timeCourant - $timeBD < $delaisAttente) {
        //si nb tentative >=4 alors bloquer QUOI qu'il arrive
        //la connexion
        $_SESSION["timeNextTentative"] = $timeBD + $delaisAttente;
        header('Location: index.php?page=authentif');
        die();
    } else {
        if (password_verify($pwd, $pwdHashBD)) {
            /* echo("passwordverify"); */
            //CAS où le mot de passe est correcte et que le temps d'attente ne bloque pas
            //l'authentification
            //le mot de passe en BD(qui a été crypté en PHP avant insertion) correspond au mot de passe saisi par l'utilisateur

            $_SESSION["etatConnexion"] = "1";
            //toutes les informations concernant l'utilisateur pourront être accessible durant la session
            $_SESSION["pseudo"] = $result['PSEUDO_UTILISATEUR'];
            $_SESSION["prenom"] = $result['PRENOM_UTILISATEUR'];
            $_SESSION["nom"] = $result['NOM_UTILISATEUR'];
            $_SESSION["mail"] = $result['ADRESSE_MAIL_UTILISATEUR'];
            $_SESSION["motdepasse"] = $result['MOT_DE_PASSE_UTILISATEUR'];
            $_SESSION["id_utilisateur"] = $result['ID_UTILISATEUR'];
            $_SESSION["statut_utilisateur"] = $result['STATUT_UTILISATEUR'];
            if (!is_null($nbConnexionFailed)) {
                //mise à jour en BD des données gerant les attaques de force brute
                majSessionNews($pdo, null, null, $pseudo);
            }
            //redirection vers la page d'accueil
            header('Location: index.php?page=accueil');
            die();
        } else { //CAS où le mot de passe est incorrecte OU le délais bloque l'accès
            //ce paramètre stocké en session permettra de savoir que la connexion a échoué
            //et donc d'afficher un message d'echec sur la page d'authentification
            $_SESSION["etatConnexion"] = "0";
            /* echo("motdepasseincorrect" .'<br>');
            echo("motdepassesaisi=". $pwd .'<br>');
            echo("motdepassehaché=". $pwdHashBD. '<br>');
            echo("motdepassesaisihaché=". password_hash($pwd, PASSWORD_DEFAULT). ); */

            //nb max de tentatives de connexion = 3

            if ($nbConnexionFailed < 3) {
                majSessionNews($pdo, $nbConnexionFailed + 1, time(), $pseudo);
            } else {
                //15 minutes avant renouvellement des tentatives

                if ($timeCourant - $timeBD < $delaisAttente) {
                    //si nb tentative >=4 alors bloquer
                    //la connexion
                    $_SESSION["timeNextTentative"] = $timeBD + $delaisAttente;
                } else {
                    //le délais est passé
                    //renouvellement des tentatives
                    majSessionNews($pdo, 1, time(), $pseudo);
                }
            }
            header('Location: index.php?page=authentif');
            die();
        }
    }
} else {
    // l'identifiant n'existe pas
    $_SESSION["etatConnexion"] = "0";
    header('Location: index.php?page=authentif');
    die();
    /* echo("utilisateurinexistant"); */
}

function majSessionNews($pdoP, $nbConnexionFailedP, $timeLastConnexionFailedP, $userP)
{
    try {
        $valDate = $timeLastConnexionFailedP;
        if (!is_null($timeLastConnexionFailedP)) {
            //si la date n'est pas null alors on gère correctement son format
            $dateTime = new DateTime();
            $dateTime->setTimestamp($timeLastConnexionFailedP);
            $valDate = $dateTime->format('Y-m-d H:i');
        }

        $stmtMAJ = $pdoP->prepare("UPDATE utilisateurs SET NBCONNEXION_UTILISATEUR = ?, DATE_CONNEXION_UTILISATEUR=? WHERE PSEUDO_UTILISATEUR=?");
        $stmtMAJ->execute([$nbConnexionFailedP, $valDate, $userP]);
        $stmtMAJ->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

