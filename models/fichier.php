<?php
class Fichier
{
    public static function upload($filesP, $values, $pdoP)
    {
        if (!empty($filesP)) {

            $file_name = $_FILES['fichier']['name']; // Information sur le nom du fichier
            $file_extension = strrchr($file_name, "."); // Information sur l'extension du fichier
            $file_size = $_FILES['fichier']['size']; // Information sur la taille du fichier

            $file_tmp_name = $_FILES['fichier']['tmp_name']; // Provenance du fichier
            $file_dest = 'Admin/files/' . $file_name; // Ici on indique la destination du fichier

            $extension_autorisees = array('.png', '.jpg', '.PNG', '.JPG'); // Ici on notera les extensions autorisées 
            $size_max = 20000000; // Ici on définira une taille maximale de notre fichier

            $intitule = htmlspecialchars($values['intitule']);
            $date = htmlspecialchars($values['date']);
            if (in_array($file_extension, $extension_autorisees) && $file_size <= $size_max) {
                // Dans la condition ci-dessus on va voir dans un premier temps si l'extension du fichier correspond aux extensions autorisées.
                // Par la suite on vérifie si la taille de notre fichier ne dépasse pas la taille max définie.
                if (move_uploaded_file($file_tmp_name, $file_dest)) {
                    $req = $pdoP->prepare('INSERT INTO oeuvres (TITRE_OEUVRE, ANNEE_OEUVRE, IMG_OEUVRES) VALUE (?,?,?)');
                    $req->execute(array($intitule, $date, $file_dest));
                    return true;
                    // Si tout est ok on envoie le fichier vers notre dossier de destination grace 
                    // à move_uploaded_file et on prépare l'insertion en base de données dans les différentes table.
                }
            }
            return false;
        }
    }
    public static function download($filesP, $values, $pdoP)
    {
        // Ici on connecte la base de données dans un premier temps.
        // Ensuite on va faire une requete pour allé chercher le nom et l'url du fichier afin de pouvoir le télécharger.
        // Par le suite on crée une boucle (foreach) afin d'afficher les différents fichiers uploader dans notre dossier files.
        $req = $pdoP->prepare('SELECT ID_OEUVRE, TITRE_OEUVRE, ANNEE_OEUVRE, IMG_OEUVRES, ID_TYPES_OEUVRES FROM oeuvres');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class=\"container mt-3\"><table class=\"table\">
        <thead class=\"thead-light\">
            <tr>
                <th>Nom du fichier</th>
                <th>Types oeuvres (ID) <br> 1 = Dessin <br> 2 = Photo <br> 3 = Logo</th>
                <th>Date oeuvre</th>
                <th>Télécharger</th>  
                <th>Supprimer</th>  
            </tr>
        </thead>
        <tbody>";
        foreach ($data as $datavalue) {
            echo "<tr>";
            echo "<td>" . $datavalue['TITRE_OEUVRE'] . "</td>";
            echo "<td>" . $datavalue['ID_TYPES_OEUVRES'] . "</td>";
            echo "<td>" . $datavalue['ANNEE_OEUVRE'] . "</td>";
            echo '<td><a href="' . $datavalue['IMG_OEUVRES'] . '"><img src="./public/ICONS/Downloadicon.png" style="width:15px; height:15px; margin-left:25px;"></a></td>';
            // Rajouter la fonction supprimer dans mon tableau ?
            echo '<td>
                    <form method="POST" action="index.php?page=envoifichier">
                        <button type="submit" name="delete" style="background:none; width:20px; height:20px; cursor:pointer; border:none;" value="' . $datavalue['ID_OEUVRE'] . '">
                            <img src="./public/ICONS/trash-can.png" style="width:15px; height:15px; margin-left:-100px;">
                        </button>
                    </form>
                </td>';
            echo "<tr>";
        }
        echo "</tbody>
        </table>
        </div>";
    }

    public static function deleteFichier($filesP, $values, $pdoP)
    {
        try {
            // Ici on connecte la base de données dans un premier temps.
            // Ensuite on va faire une requete pour allé chercher le nom et l'url du fichier afin de pouvoir le télécharger.
            // Par le suite on crée une boucle (foreach) afin d'afficher les différents fichiers uploader dans notre dossier files.
            $req = $pdoP->prepare('DELETE FROM oeuvres WHERE ID_OEUVRE=?');
            $req->execute([$values['delete']]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}