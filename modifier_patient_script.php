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

// Vérification des données postées depuis le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des données entrées
    $id = $_POST['id'];
    $username = $_POST['username']; // Correction ici
    $email = $_POST['email'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];

    // Préparation de la requête SQL pour mettre à jour les informations du patient
    $sql = "UPDATE patients SET username=?, email=?, address=?, sex=?, phone=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $email, $address, $sex, $phone, $id);
    $stmt->execute();

    echo "Les informations du patient ont été mises à jour avec succès.";

    $stmt->close();
}

$conn->close();
?>
