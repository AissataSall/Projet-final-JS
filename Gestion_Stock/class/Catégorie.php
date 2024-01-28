<?php
include ("Connection.php");
class Categorie {
    private $idcategorie;
    private $nom_categorie;
    private $description;

    // Constructeur
    public function __construct($nom_categorie, $description) {
        $this->nom_categorie = $nom_categorie;
        $this->description = $description;
    }

    // Getter pour l'ID de la catégorie
    public function getIdCategorie() {
        return $this->idcategorie;
    }

    // Getter pour le nom de la catégorie
    public function getNomCategorie() {
        return $this->nom_categorie;
    }

    // Getter pour la description de la catégorie
    public function getDescription() {
        return $this->description;
    }

    // Setter pour l'ID de la catégorie
    public function setIdCategorie($idcategorie) {
        $this->idcategorie = $idcategorie;
    }

    // Méthode pour insérer une nouvelle catégorie dans la base de données
    public function insererCategorie() {
        global $conn;

        $nom_categorie = $this->nom_categorie;
        $description = $this->description;

        $sql = "INSERT INTO categorie (nom_categorie, description) VALUES ('$nom_categorie', '$description')";

        if ($conn->query($sql) === TRUE) {
            $this->idcategorie = $conn->insert_id;
            return true; // Retourne vrai si l'insertion a réussi
        } else {
            return false; // Retourne faux en cas d'erreur
        }
    }

    // Méthode pour récupérer toutes les catégories de la base de données
    public static function getAllCategories() {
        global $conn;

        $categories = array();

        $sql = "SELECT * FROM categorie";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categorie = new Categorie($row['nom_categorie'], $row['description']);
                $categorie->setIdCategorie($row['idcategorie']);
                $categories[] = $categorie;
            }
        }

        return $categories;
    }

    // Méthode pour mettre à jour une catégorie dans la base de données
    public function mettreAJourCategorie() {
        global $conn;

        $idcategorie = $this->idcategorie;
        $nom_categorie = $this->nom_categorie;
        $description = $this->description;

        $sql = "UPDATE categorie SET nom_categorie='$nom_categorie', description='$description' WHERE idcategorie=$idcategorie";

        return $conn->query($sql);
    }


    // Méthode pour récupérer une catégorie par son ID
    public static function getCategorieById($idcategorie) {
        global $conn;

        $sql = "SELECT * FROM categorie WHERE idcategorie=$idcategorie";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $categorie = new Categorie($row['nom_categorie'], $row['description']);
            $categorie->setIdCategorie($row['idcategorie']);
            return $categorie;
        }

        return null;
    }

    // Méthode pour supprimer une catégorie de la base de données
    public function supprimerCategorie($idcategorie) {
        global $conn;

        $idcategorie = $this->idcategorie;

        $sql = "DELETE FROM categorie WHERE idcategorie=$idcategorie";

        return $conn->query($sql);
    }
}
?>