<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les données JSON envoyées par le client
    $data = json_decode(file_get_contents('php://input'), true);
    $status = $data['status'];

    // Mettre à jour le statut du patient
    $sql = "UPDATE patients SET status=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $status, $email);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}
?>
