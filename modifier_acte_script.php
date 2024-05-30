<?php
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
    $nom = $_POST['nom'];
    $usertype = $_POST['usertype'];

    $sql = "UPDATE actes_paramedicaux SET nom = ?, usertype = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nom, $usertype, $id);

    if ($stmt->execute() === TRUE) {
        echo "Acte paramédical modifié avec succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: actsparamedicaux.php");
exit();
?>
