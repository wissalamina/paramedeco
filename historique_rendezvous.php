<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: historique_rendezvous.php");
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

$sql = "SELECT r.id, p.username AS patient, prof.username AS professionnel, r.date_rendez_vous, r.heure_rendez_vous, r.acte_paramedical, r.statut
        FROM rendez_vous r
        JOIN patients p ON r.patients_id = p.id
        JOIN professionnels prof ON r.professionnels_id = prof.id
        WHERE r.patients_id = ?
        ORDER BY r.date_rendez_vous ASC, r.heure_rendez_vous ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des rendez-vous</title>
    <link rel="stylesheet" href="">
</head>
<body>
<div class="container">
    <h2>Historique des rendez-vous</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h3>Rendez-vous #" . $row["id"] . "</h3>";
            echo "<p><strong>Patient:</strong> " . $row["patient"] . "</p>";
            echo "<p><strong>Professionnel:</strong> " . $row["professionnel"] . "</p>";
            echo "<p><strong>Date:</strong> " . $row["date_rendez_vous"] . "</p>";
            echo "<p><strong>Heure:</strong> " . $row["heure_rendez_vous"] . "</p>";
            echo "<p><strong>Acte paramédical:</strong> " . $row["acte_paramedical"] . "</p>";
            echo "<p><strong>Statut:</strong> " . $row["statut"] . "</p>";
            if ($row["statut"] != "annule" && $row["statut"] != "confirme") {
                echo "<form method='post' action='annuler_rendezvous.php' onsubmit='return confirm(\"Voulez-vous vraiment annuler ce rendez-vous?\");'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='submit' value='Annuler'>
                      </form>";
            }
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucun rendez-vous trouvé</p>";
    }
    $stmt->close();
    $conn->close();
    ?>
</div>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
}

.container {
    max-width: 1000px;
    margin: auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 10px 20px;
}

.card h3 {
    margin-top: 0;
}

.card p {
    margin: 10px 0;
}

form {
    display: inline;
}

form input[type="submit"] {
    padding: 5px 10px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #e31e0b;
}

    </style>
</body>
</html>
