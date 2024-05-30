<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

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

    // Vérifier que le rendez-vous appartient bien à l'utilisateur connecté
    $sql_check = "SELECT patients_id FROM rendez_vous WHERE id = ? AND patients_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $id, $user_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $sql = "UPDATE rendez_vous SET statut = 'annule' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Rendez-vous annulé avec succès.";
        } else {
            echo "Erreur: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Vous n'avez pas la permission d'annuler ce rendez-vous.";
    }

    $stmt_check->close();
    $conn->close();
    header("Location: historique_rendezvous.php");
    exit();
}
?>
