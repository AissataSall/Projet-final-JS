

<?php

class Produit {
    private $idproduit;
    private $nom_produit;
    private $categorie_id;
    private $qte;
    private $prix_unitaire;
    private $description;

    // Constructeur
    public function __construct($nom_produit, $categorie_id, $qte, $prix_unitaire, $description) {
        $this->nom_produit = $nom_produit;
        $this->categorie_id = $categorie_id;
        $this->qte = $qte;
        $this->prix_unitaire = $prix_unitaire;
        $this->description = $description;
    }

    // Getter pour l'ID du produit
    public function getIdProduit() {
        return $this->idproduit;
    }

    // Getter pour le nom du produit
    public function getNomProduit() {
        return $this->nom_produit;
    }

    // Getter pour l'ID de la catégorie
    public function getCategorieId() {
        return $this->categorie_id;
    }

    // Getter pour la quantité
    public function getQuantite() {
        return $this->qte;
    }

    // Getter pour le prix unitaire
    public function getPrixUnitaire() {
        return $this->prix_unitaire;
    }

    // Getter pour la description
    public function getDescription() {
        return $this->description;
    }

    // Setter pour l'ID du produit
    public function setIdProduit($idproduit) {
        $this->idproduit = $idproduit;
    }

    // Méthode pour insérer un nouveau produit dans la base de données
    public function insererProduit() {
        global $conn;

        $nom_produit = $this->nom_produit;
        $categorie_id = $this->categorie_id;
        $qte = $this->qte;
        $prix_unitaire = $this->prix_unitaire;
        $description = $this->description;

        $sql = "INSERT INTO produits (nom_produit, categorie_id, qte, prix_unitaire, description) VALUES ('$nom_produit', '$categorie_id', '$qte', '$prix_unitaire', '$description')";

        if ($conn->query($sql) === TRUE) {
            $this->idproduit = $conn->insert_id;
            return true; // Retourne vrai si l'insertion a réussi
        } else {
            return false; // Retourne faux en cas d'erreur
        }
    }

    // Méthode pour récupérer tous les produits de la base de données
    public static function getAllProduits() {
        global $conn;

        $produits = array();

        $sql = "SELECT * FROM produits";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produit = new Produit($row['nom_produit'], $row['categorie_id'], $row['qte'], $row['prix_unitaire'], $row['description']);
                $produit->setIdProduit($row['idproduit']);
                $produits[] = $produit;
            }
        }

        return $produits;
    }

    // Méthode pour récupérer un produit par son ID
    public static function getProduitById($idproduit) {
        global $conn;

        $sql = "SELECT * FROM produits WHERE idproduit=$idproduit";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $produit = new Produit($row['nom_produit'], $row['categorie_id'], $row['qte'], $row['prix_unitaire'], $row['description']);
            $produit->setIdProduit($row['idproduit']);
            return $produit;
        }

        return null;
    }

     // Méthode pour mettre à jour un produit dans la base de données
     public function mettreAJourProduit() {
        global $conn;

        $idproduit = $this->idproduit;
        $nom_produit = $this->nom_produit;
        $categorie_id = $this->categorie_id;
        $qte = $this->qte;
        $prix_unitaire = $this->prix_unitaire;
        $description = $this->description;

        $sql = "UPDATE produits SET nom_produit='$nom_produit', categorie_id='$categorie_id', qte='$qte', prix_unitaire='$prix_unitaire', description='$description' WHERE idproduit=$idproduit";

        return $conn->query($sql);
    }


// Méthode pour supprimer un produit de la base de données
public function supprimerProduit() {
    global $conn;

    $idproduit = $this->idproduit;

    $sql = "DELETE FROM produits WHERE idproduit=$idproduit";

    return $conn->query($sql);
}

}




?>

