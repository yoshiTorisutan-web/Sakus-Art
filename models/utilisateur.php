<?php
class Utilisateur
{
    public static function create($pdoP, $values)
    {
        //création de l'utilisateur
        $pseudo = htmlspecialchars($values['pseudo']);
        $mail = htmlspecialchars($values['mail']);
        $pwd = htmlspecialchars($values['motdepasse']);
        $prenom = htmlspecialchars($values['prenom']);
        $nom = htmlspecialchars($values['nom']);

        try {
            $stmt = $pdoP->prepare("INSERT INTO utilisateurs (PSEUDO_UTILISATEUR, ADRESSE_MAIL_UTILISATEUR, MOT_DE_PASSE_UTILISATEUR, PRENOM_UTILISATEUR, NOM_UTILISATEUR) VALUES (?,?,?,?,?)");
            $stmt->execute([$pseudo, $mail, password_hash($pwd, PASSWORD_DEFAULT), $prenom, $nom]);
            header('Location: index.php?page=authentif&creation=ok');
            die();
        } catch (PDOException $e) {
            /* header('Location: index.php?page=error404');
            die(); */
            echo "Erreur  : " . $e->getMessage();
        }
    }

    public static function update($pdoP, $values)
    {
        // mettre à jour les données de l'utilisateur dans la BDD
        // récupération de l'ensemble des données de l'utilisateur avec la création de son compte
        $pseudo = htmlspecialchars($values['pseudo']);
        $prenom = htmlspecialchars($values['prenom']);
        $nom = htmlspecialchars($values['nom']);
        $mail = htmlspecialchars($values['mail']);
        $pwd = htmlspecialchars($values['motdepasse']);
        $id = $_SESSION["id_utilisateur"];
        try {
            $sql = 'UPDATE utilisateurs SET PSEUDO_UTILISATEUR=?, PRENOM_UTILISATEUR=?, NOM_UTILISATEUR=?, ADRESSE_MAIL_UTILISATEUR=?, MOT_DE_PASSE_UTILISATEUR=? WHERE ID_UTILISATEUR=?';
            $stmt = $pdoP->prepare($sql);
            $stmt->execute([$pseudo, $prenom, $nom, $mail, password_hash($pwd, PASSWORD_DEFAULT), $id]);
            // mise à jour des données en BDD et sur la page avec raffraichissement de la page pour voir la modification
            Utilisateur::refresh($pseudo, $prenom, $nom, $mail);
            header('Location: index.php?page=profilUtilisateur&confirmLogin=ok');
            die();
        } catch (PDOException $e) {
            header('Location: index.php?page=error404');
            die();
            //echo $e;
        }
    }

    private static function refresh($pseudo, $prenom, $nom, $mail)
    {
        // mettre à jour les données de l'utilisateur dans la session
        $_SESSION["pseudo"] = $pseudo;
        $_SESSION["prenom"] = $prenom;
        $_SESSION["nom"] = $nom;
        $_SESSION["mail"] = $mail;
    }

    public static function modifPwd($pdoP, $values){
        $n_password = htmlspecialchars($values['new-motdepasse']);
        $id = $_SESSION["id_utilisateur"];
        try {
            $sql = 'UPDATE utilisateurs SET MOT_DE_PASSE_UTILISATEUR=? WHERE ID_UTILISATEUR=?';
            $stmt = $pdoP->prepare($sql);
            $stmt->execute([password_hash($n_password, PASSWORD_DEFAULT), $id]);
            header('Location: index.php?page=profilUtilisateur&confirmPassword=ok');
            die();
        } catch (PDOException $e) {
            /* header('Location: index.php?page=error404');
            die(); */
            echo $e;
        }
    }

    /* Vérification du pseudo identique ou non afin d'éviter les doublons */
    public static function SamePwd($pdo, $values)
    {
        $pseudo = htmlspecialchars($values['pseudo']);
        $stmt = $pdo->prepare("SELECT ID_UTILISATEUR FROM utilisateurs WHERE PSEUDO_UTILISATEUR=?");
        $stmt->execute([$pseudo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* Vérification du mail identique ou non afin d'éviter les doublons */
    public static function SameMail($pdo, $values)
    {
        $mail = htmlspecialchars($values['mail']);
        $stmt = $pdo->prepare("SELECT ID_UTILISATEUR FROM utilisateurs WHERE ADRESSE_MAIL_UTILISATEUR=?");
        $stmt->execute([$mail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* fonction qui renvoie l'id de l'utilisateur et son email */
    public static function getMail($pdoP, $pseudoP)
    {
        $stmt = $pdoP->prepare("SELECT ADRESSE_MAIL_UTILISATEUR FROM utilisateurs WHERE PSEUDO_UTILISATEUR=?");
        $stmt->execute([$pseudoP]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['ADRESSE_MAIL_UTILISATEUR'];
    }

    //fonction qui met à jour pour un identifiant donné la date du jeton et la valeur du jeton
    //pour une réinitialisation du mot de passe
    public static function updateToken($pdoP, $tokenP, $pseudoP)
    {
        //ATTENTION l'identifiant doit être unique
        $stmt = $pdoP->prepare("UPDATE utilisateurs SET PWD_CHANGE_DATE=NOW(), PWD_CHANGE_TOKEN=? WHERE PSEUDO_UTILISATEUR=?");
        $stmt->execute([$tokenP, $pseudoP]);
    }

    //fonction qui renvoie les infos spécifiques à un jeton passé en paramètre
    public static function getInfosToken($pdoP, $tokenP)
    {
        //ATTENTION l'identifiant doit être unique
        $stmt = $pdoP->prepare("SELECT PWD_CHANGE_DATE, PSEUDO_UTILISATEUR FROM utilisateurs WHERE PWD_CHANGE_TOKEN=?");
        $stmt->execute([$tokenP]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //fonction qui modifie le mot de passe et enlève les infos concernant le token
    public static function reinitPwd($pdoP, $values)
    {
        //ATTENTION l'identifiant doit être unique
        $pseudo = htmlspecialchars($values['pseudo']);
        $pwd = htmlspecialchars($values['motdepasse']);
        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt = $pdoP->prepare("UPDATE utilisateurs SET PWD_CHANGE_DATE=NULL, PWD_CHANGE_TOKEN=NULL, MOT_DE_PASSE_UTILISATEUR=? WHERE PSEUDO_UTILISATEUR=?");
        $stmt->execute([$pwdHash, $pseudo]);
    }
}
