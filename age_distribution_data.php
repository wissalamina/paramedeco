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

// Définir les tranches d'âge
$age_ranges = [
    '0-18' => "0 AND 18",
    '19-30' => "19 AND 30",
    '31-45' => "31 AND 45",
    '46-60' => "46 AND 60",
    '61+' => "61 AND 100" // Assumer l'âge max de 100
];

$data = [];

foreach ($age_ranges as $range => $condition) {
    $sql = "SELECT COUNT(*) as count FROM patients WHERE TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN $condition";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data[] = ['age_range' => $range, 'count' => $row['count']];
}

echo json_encode($data);

mysqli_close($conn);
?>
