<?php
session_start(); // Démarrer la session
if (isset($_SESSION['username'])) {
    // Mettre à jour le statut dans la base de données à "hors ligne"
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $username = $_SESSION['username'];
    $sql = "UPDATE patients SET status='hors ligne' WHERE username='$username'";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Erreur lors de la mise à jour du statut : " . $conn->error;
    }

    $conn->close();

    // Détruire la session
    session_unset();
    session_destroy();
}

// Rediriger vers une autre page après la déconnexion
header("Location: login.php");
exit();
?>
