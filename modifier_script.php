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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $usertype = $_POST['usertype'];

    // Préparation de la requête SQL pour mettre à jour les informations du membre
    $sql = "UPDATE professionnels SET username=?, email=?, address=?, sex=?, phone=?, usertype=? WHERE id=?";
    
    // Préparation de la déclaration
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres et exécution de la requête
    $stmt->bind_param("ssssssi", $username, $email, $address, $sex, $phone, $usertype, $id);


    if ($stmt->execute()) {
        echo "Les informations du membre ont été mises à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des informations du membre: " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

$conn->close();
?>
