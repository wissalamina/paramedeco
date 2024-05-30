<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des patients</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
<div class="container">
<div class="topbar">
    <a href="nouveau_patient.php" class="add-button">Ajouter</a>
</div>

<h2>Liste des patients</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="nombre"></label>
    <input type="submit" value="Afficher" name="submit" class="show-button">
    <select name="nombre" id="nombre" class="select-box">
        <option value="0" <?php if(isset($_POST['nombre']) && $_POST['nombre'] == 0) echo 'selected'; ?>>Tout</option>
        <?php
        for ($i = 1; $i <= 50; $i++) {
            echo "<option value='$i' ".(isset($_POST['nombre']) && $_POST['nombre'] == $i ? 'selected' : '').">$i</option>";
        }
        ?>
    </select>
</form>
    <table border="1" id="tableauPatients">
      
    <?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_count = "SELECT COUNT(*) AS total_patients FROM patients";

$result_count = $conn->query($sql_count);
$total_patients = 0;

if ($result_count->num_rows > 0) {
    $row = $result_count->fetch_assoc();
    $total_patients = $row["total_patients"];
}

if ($total_patients == 0) {
    $output = "<tr><td colspan='9'>Aucun patient trouvé</td></tr>";
} else {
    $selected_value = isset($_POST['nombre']) ? $_POST['nombre'] : 0;
    $limit = ($selected_value > 0) ? $selected_value : $total_patients;

    $sql = "SELECT id, username, email, address, sex, phone FROM patients ORDER BY id DESC LIMIT $limit";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = "<tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Sexe</th>
                        <th>Téléphone</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td>" . $row["id"] . "</td>";
            $output .= "<td>" . $row["username"] . "</td>";
            $output .= "<td>" . $row["email"] . "</td>";
            $output .= "<td>" . $row["address"] . "</td>";
            $output .= "<td>" . $row["sex"] . "</td>";
            $output .= "<td>" . htmlspecialchars($row["phone"]) . "</td>"; // Use htmlspecialchars to ensure special characters are properly handled
            $output .= "<td><a href='#' onclick='confirmDelete(\"" . $row["username"] . "\")' class='delete-button'>Supprimer</a></td>";
            $output .= "<td><a href='modifier_patient.php?id=" . $row["id"] . "' class='modifier-link'>Modifier</a></td>";
            $output .= "</tr>";
        }
    }
}

echo $output;

$conn->close();
?>

    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitForm() {
        document.querySelector("form").submit();
    }

    window.onload = submitForm;
</script>
<script>
    function confirmDelete(nomComplet) {
        if (confirm("Voulez-vous vraiment supprimer ce patient " + nomComplet + " ?")) {
            window.location.href = 'supprimer_patient.php?nomComplet=' + nomComplet;
        } else {
            return false;
        }
    }
</script>
</body>
</html>
