<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actes paramédicaux</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
<div class="container">
<div class="topbar">
    <a href="nouvel_acte.php" class="add-button">Ajouter</a>
</div>

<h2>Liste des actes paramédicaux</h2>
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
    <table border="1" id="tableauActes">
      
    <?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_count = "SELECT COUNT(*) AS total_actes FROM actes_paramedicaux";

$result_count = $conn->query($sql_count);
$total_actes = 0;

if ($result_count->num_rows > 0) {
    $row = $result_count->fetch_assoc();
    $total_actes = $row["total_actes"];
}

if ($total_actes == 0) {
    $output = "<tr><td colspan='8'>Aucun acte trouvé</td></tr>";
} else {
    $selected_value = isset($_POST['nombre']) ? $_POST['nombre'] : 0;
    $limit = ($selected_value > 0) ? $selected_value : $total_actes;

    $sql = "SELECT id, nom, usertype 
            FROM actes_paramedicaux 
            ORDER BY id ASC LIMIT $limit";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = "<tr>
                        <th>ID</th>
                        <th>Nom de l'acte</th>
                        <th>Spécialité</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td>" . $row["id"] . "</td>";
            $output .= "<td>" . $row["nom"] . "</td>";
            $output .= "<td>" . $row["usertype"] . "</td>";
            $output .= "<td><a href='modifier_acte.php?id=" . $row["id"] . "' class='modifier-link'>Modifier</a></td>";
            $output .= "<td><a href='#' onclick='confirmDelete(" . $row["id"] . ")' class='delete-button'>Supprimer</a></td>";
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
    function confirmDelete(id) {
        if (confirm("Voulez-vous vraiment supprimer cet acte " + id + " ?")) {
            window.location.href = 'supprimer_acte.php?id=' + id;
        } else {
            return false;
        }
    }
</script>

</body>
</html>
