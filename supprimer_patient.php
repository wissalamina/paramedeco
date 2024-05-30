<?php
// Vérifier si le nom complet du patient est passé en tant que paramètre GET
if (isset($_GET["nomComplet"])) {
    // Connexion à la base de données
    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "user";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Supprimer le patient de la base de données en utilisant le nom complet
    $nomComplet = $_GET["nomComplet"];
    $sql = "DELETE FROM patients WHERE username='$nomComplet'";

    if ($conn->query($sql) === TRUE) {
        echo "Patient supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression du patient: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Nom complet du patient non spécifié.";
}
?>
