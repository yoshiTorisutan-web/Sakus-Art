<?php
    class Oeuvres{
        public static function getDrawing($pdo){
    
            $stmt = $pdo->prepare("SELECT ID_OEUVRE, IMG_OEUVRES, TITRE_OEUVRE, ANNEE_OEUVRE FROM oeuvres WHERE ID_TYPES_OEUVRES = 1");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getImage($pdo){
    
            $stmt = $pdo->prepare("SELECT ID_OEUVRE, IMG_OEUVRES, TITRE_OEUVRE, ANNEE_OEUVRE FROM oeuvres WHERE ID_TYPES_OEUVRES = 2");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public static function getLogo($pdo){
    
            $stmt = $pdo->prepare("SELECT ID_OEUVRE, IMG_OEUVRES, TITRE_OEUVRE, ANNEE_OEUVRE FROM oeuvres WHERE ID_TYPES_OEUVRES = 3");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getTechnique($pdo, $idOeuvre){
    
            $stmt = $pdo->prepare("SELECT techniques_oeuvres.LIBELLE_TECHNIQUE FROM techniques_oeuvres 
            INNER JOIN utiliser on techniques_oeuvres.ID_TECHNIQUE = utiliser.ID_TECHNIQUE 
            WHERE utiliser.ID_OEUVRE = ?");
            $stmt->execute([$idOeuvre]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>