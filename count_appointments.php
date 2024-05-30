<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS total_appointments FROM rendez_vous WHERE statut = 'confirmé'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["total_appointments"];
} else {
    echo "0";
}

$conn->close();
?>
