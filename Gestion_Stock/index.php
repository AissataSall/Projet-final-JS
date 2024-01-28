<?php
include("class/Connection.php");

// Fonction pour obtenir le nombre total de catégories
function getAllCategories() {
    global $conn;

    if (!isset($conn) || $conn->connect_error) {
        include("class/Connection.php"); 
    }

    $sql = "SELECT COUNT(*) AS total FROM categorie";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}

// Fonction pour obtenir le nombre total de produits
function getAllProduits() {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM produits";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}

// Fermer la connexion à la base de données
//$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion de Stock</title>
    <link rel="stylesheet" href="css/accueil.css">

</head>
<body>

    <header>
        <h1>Gestion de Stock</h1>
    </header>

    <section>
        <h2>Informations</h2>
        <p>Total des Catégories: <?php echo getAllCategories(); ?></p> 
        <p>Total des Produits: <?php echo getAllProduits(); ?></p> 
    </section>

    <section>
        <h2>Rubriques</h2>
        <ul>
            <li><a href="page/catégorie.php">Gestion des Catégories</a></li> 
            <li><a href="page/produit.php">Gestion des Produits</a></li> 
        </ul>
    </section>

</body>
</html>


