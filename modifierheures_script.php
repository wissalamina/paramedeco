<?php
// Connexion à la base de données
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Préparer et exécuter la requête de mise à jour
    $sql = "UPDATE professionnels SET start_time = ?, end_time = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $start_time, $end_time, $id);

    if ($stmt->execute() === TRUE) {
        echo "Heures de travail mises à jour avec succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
