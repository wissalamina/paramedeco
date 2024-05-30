<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un membre</title>
</head>
<body>

<?php
// Vérifier si le nom d'utilisateur est passé en tant que paramètre GET
if (isset($_GET["username"])) {
    // Connexion à la base de données
    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "user";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer le nom d'utilisateur du membre à supprimer
    $username = $_GET["username"];

    // Préparation de la requête SQL pour supprimer le membre de la table 'professionnels'
    $sql = "DELETE FROM professionnels WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    // Exécuter la requête et vérifier si un membre a été supprimé
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo "<p>Membre supprimé avec succès</p>";
    } else {
        echo "<p>Le membre avec le nom d'utilisateur '$username' n'existe pas dans la base de données</p>";
    }

    // Fermer la déclaration et la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>

<a href="equipe_medical.php">Retour à la liste des membres</a>

</body>
</html>
