<?php
include("../class/Connection.php");
include("../class/Produit.php");
include("../class/Catégorie.php");

// Traitement du formulaire d'ajout de produit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ajouter_produit'])) {
        $nom_produit = $_POST['nom_produit'];
        $categorie_id = $_POST['categorie_id'];
        $qte = $_POST['qte'];
        $prix_unitaire = $_POST['prix_unitaire'];
        $description = $_POST['description'];

        // Création d'un nouvel objet Produit
        $nouveauProduit = new Produit($nom_produit, $categorie_id, $qte, $prix_unitaire, $description);

        // Insertion du produit dans la base de données
        if ($nouveauProduit->insererProduit()) {
            echo "Produit ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du produit.";
        }
    }
    // Ajoutez ici la logique pour les boutons "Modifier" et "Supprimer"
}

// Récupération des produits existants
$produitsExistants = Produit::getAllProduits();
// Récupération des catégories pour le menu déroulant
$categories = Categorie::getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="../css/style.css">
    <nav>
        <ul>
            <li><a href="../index.php">Accueil</a></li> 
            <li><a href="catégorie.php">Gestion des Catégories</a></li>
        </ul>
    </nav>
</head>
<body>

    <h1>Ajouter un Produit</h1>

    <!-- Formulaire pour ajouter un produit -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom_produit">Nom du Produit:</label>
        <input type="text" name="nom_produit" required>

        <label for="categorie_id">ID de la Catégorie:</label>
        <select name="categorie_id" required>
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?php echo $categorie->getIdCategorie(); ?>"><?php echo $categorie->getIdCategorie(); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="qte">Quantité:</label>
        <input type="number" name="qte" required>

        <label for="prix_unitaire">Prix Unitaire:</label>
        <input type="number" name="prix_unitaire" required>

        <label for="description">Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <button type="submit" name="ajouter_produit">Ajouter le Produit</button>
    </form>

    <!-- Tableau pour afficher les produits existants -->
    <h2>Produits existants</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Produit</th>
                <th>Catégorie</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produitsExistants as $produit) : ?>
                <tr>
                    <td><?php echo $produit->getIdProduit(); ?></td>
                    <td><?php echo $produit->getNomProduit(); ?></td>
                    <td><?php echo $produit->getCategorieId(); ?></td>
                    <td><?php echo $produit->getQuantite(); ?></td>
                    <td><?php echo $produit->getPrixUnitaire(); ?></td>
                    <td><?php echo $produit->getDescription(); ?></td>
                    <td>
                        <button onclick="modifierProduit(<?php echo $produit->getIdProduit(); ?>)">Modifier</button>
                        <button onclick="supprimerProduit(<?php echo $produit->getIdProduit(); ?>)">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        // Fonctions JavaScript pour gérer les actions de modification et de suppression
        function modifierProduit(id) {
            // Ajoutez ici la logique pour la modification
            alert("Modifier le produit avec l'ID " + id);
        }

        function supprimerProduit(id) {
            // Ajoutez ici la logique pour la suppression
            alert("Supprimer le produit avec l'ID " + id);
        }
    </script>

</body>
</html>
