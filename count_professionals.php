<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "user"; // Remplacez "user" par le nom de votre base de données si différent

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Compter le nombre total de professionnels de santé
$sql = "SELECT COUNT(*) as total FROM professionnels";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["total"];
} else {
    echo "0";
}

$conn->close();
?>
