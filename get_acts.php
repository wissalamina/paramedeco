<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "user";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$specialty = $_POST['specialty'];

$sql = "SELECT id, nom FROM actes_paramedicaux WHERE usertype='$specialty'";
$result = mysqli_query($conn, $sql);

$acts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $acts[] = $row;
}

echo json_encode($acts);

mysqli_close($conn);
?>
