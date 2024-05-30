<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour joindre les tables rendez_vous et professionnels et compter les spécialités
$sql = "SELECT p.usertype AS usertype, COUNT(*) AS count 
        FROM rendez_vous r
        JOIN professionnels p ON r.professionnels_id = p.id
        GROUP BY p.usertype
        ORDER BY count DESC";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
