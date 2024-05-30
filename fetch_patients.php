<?php
// Connexion à la base de données
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer le nombre de patients à afficher
$nombre = $_POST['nombre'];

// Sélectionner les données des patients
$sql = "SELECT * FROM patients";

// Si le nombre n'est pas défini ou égal à zéro, sélectionner tous les patients
if ($nombre != 0) {
    $sql .= " LIMIT $nombre";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les données des patients dans un tableau
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['sex'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        // Bouton de suppression avec un lien pour supprimer le patient
        echo "<td><a href='supprimer_patient.php?username=".$row['username']."'>Supprimer</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucun patient trouvé</td></tr>";
}
$conn->close();
?>
