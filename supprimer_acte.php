<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM actes_paramedicaux WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "Acte supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression de l'acte: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de l'acte non spécifié.";
}

$conn->close();
header("Location: actsparamedicaux.php");
exit();
?>
