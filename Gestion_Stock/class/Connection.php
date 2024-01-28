<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "db_stock";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

//Verification de la connexion
if($conn->connect_error) {
    die("La connexion de la base de données n'est pas bien faite " .$conn->connect_error);
}
//echo "Bienvenue";
?>