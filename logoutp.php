<?php
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Mettre à jour le statut à "hors ligne"
    $update_status_sql = "UPDATE professionnels SET statut='hors ligne' WHERE email='$email'";
    mysqli_query($conn, $update_status_sql);

    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header('Location: login.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>
