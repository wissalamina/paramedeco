<?php
// Connexion à la base de données (à remplacer par vos propres informations de connexion)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Requête SQL pour compter le nombre total de patients
$sql = "SELECT COUNT(*) AS total_patients FROM patients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Récupération du nombre total de patients
    $row = $result->fetch_assoc();
    $total_patients = $row["total_patients"];
} else {
    $total_patients = 0;
}

// Fermeture de la connexion à la base de données
$conn->close();

// Retourner le nombre total de patients
echo $total_patients;
?>
