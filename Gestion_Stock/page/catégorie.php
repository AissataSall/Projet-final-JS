<?php
include ("../class/Connection.php");
include_once ("../class/Catégorie.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['ajouter_categorie'])) {
        $nom_categorie = $_POST['nom_categorie'];
        $description = $_POST['description'];

        $nouvelleCategorie = new Categorie($nom_categorie, $description);
        $nouvelleCategorie->insererCategorie();
    }

    if ($_GET["action"] == "mettreAJourCategorie") {
        $id = $_GET["id"];
        $nom_categorie = $_POST["nom_categorie"];
        $description = $_POST["description"];

        $categorie = new Categorie("", "");  // Créez une instance avec des valeurs par défaut
        $categorie->setIdCategorie($id);
        $result = $categorie->mettreAJourCategorie($nom_categorie, $description);

        echo $result ? "Mise à jour réussie" : "Erreur lors de la mise à jour";
    } elseif ($_GET["action"] == "supprimerCategorie") {
        $id = $_GET["id"];

        $categorie = new Categorie("", "");  // Créez une instance avec des valeurs par défaut
        $categorie->setIdCategorie($id);
        $result = $categorie->supprimerCategorie();

        echo $result ? "Suppression réussie" : "Erreur lors de la suppression";
    }
    // Ajoutez des conditions pour d'autres actions si nécessaire

    
      }





    // Ajoutez ici la gestion d'autres formulaires si nécessaire


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Catégorie</title>
    <link rel="stylesheet" href="../css/style.css"> 
    <nav>
        <ul>
            <li><a href="../index.php">Accueil</a></li> 
            <li><a href="produit.php">Gestion des Produits</a></li>
        </ul>
    </nav>
</head>
<body>

    <h1>Ajouter une Catégorie</h1>
    <!-- Formulaire pour ajouter une catégorie -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom_categorie">Nom de la Catégorie:</label>
        <input type="text" name="nom_categorie"value="<?php echo isset($nom_categorie) ? $nom_categorie : ''; ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" rows="4" required><?php echo isset($description) ? $description : ''; ?></textarea>

        <button type="submit" name="ajouter_categorie">Ajouter Catégorie</button>
    </form>

    

    <!-- Tableau pour afficher les catégories existantes -->
    <h2>Catégories existantes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Catégorie</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categories = Categorie::getAllCategories();
            foreach ($categories as $categorie) {
                echo "<tr>";
                echo "<td>{$categorie->getIdCategorie()}</td>";
                echo "<td>{$categorie->getNomCategorie()}</td>";
                echo "<td>{$categorie->getDescription()}</td>";
                echo "<td><button onclick=\"modifierCategorie({$categorie->getIdCategorie()})\">Modifier</button> <button onclick=\"supprimerCategorie({$categorie->getIdCategorie()})\">Supprimer</button></td>";
                
            }
            ?>
        </tbody>
    </table>
    
    <script>
    function modifierCategorie(id) {
        // Récupérer les nouvelles données depuis l'interface utilisateur (par exemple, les valeurs des champs de formulaire)
        var nouvellesDonnees = {
            nom_categorie: document.getElementById('nom_categorie').value,
            description: document.getElementById('description').value
            // ... récupérer les données à partir de l'interface utilisateur ...
        };

        // Effectuer une requête AJAX pour mettre à jour la catégorie
        $.ajax({
            type: 'POST',
            url: '../class/Catégorie.php?action=mettreAJourCategorie&id=' + id,
            data: nouvellesDonnees,
            success: function(response) {
                // Gérer la réponse du serveur (peut être une confirmation de mise à jour)
                alert(response);
            },
            error: function(error) {
                // Gérer les erreurs, si nécessaire
                console.error(error);
            }
        });
    }

    function supprimerCategorie(id) {
        // Demander confirmation à l'utilisateur
        var confirmation = confirm("Êtes-vous sûr de vouloir supprimer la catégorie avec l'ID " + id + "?");

        // Si l'utilisateur confirme, effectuer une requête AJAX pour supprimer la catégorie
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: '../class/Catégorie.php?action=supprimerCategorie&id=' + id,
                success: function(response) {
                    // Gérer la réponse du serveur (peut être une confirmation de suppression)
                    alert(response);
                },
                error: function(error) {
                    // Gérer les erreurs, si nécessaire
                    console.error(error);
                }
            });
        }
    }
</script>


    

</body>
</html>




