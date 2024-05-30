<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $statut = $_POST['statut'];

    $sql = "UPDATE rendez_vous SET statut = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $statut, $id);

    if ($stmt->execute()) {
        echo "Statut mis à jour avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: rendezvous.php");
    exit();
}
?>
