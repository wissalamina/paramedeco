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

// Récupérer les données du formulaire
$id = $_POST['id']; // Supposons que vous avez un champ caché pour l'ID du membre
$newUsername = $_POST['new_username'];
$newEmail = $_POST['new_email'];
$newAddress = $_POST['new_address'];
$newSex = $_POST['new_sex'];

// Préparer et exécuter la requête de mise à jour
$sql = "UPDATE membres SET username='$newUsername', email='$newEmail', address='$newAddress', sex='$newSex' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    // Mise à jour réussie
    header("Location: equipe_medical.php"); // Rediriger vers la page de liste des membres
    exit();
} else {
    // Erreur lors de la mise à jour
    echo "Erreur lors de la mise à jour: " . $conn->error;
}

$conn->close();
?>
