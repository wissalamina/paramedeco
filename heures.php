<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heures de travail</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
<div class="container">
<div class="topbar">
    <a href=></a>
</div>

<h2>Heures de travail</h2>
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
    <table border="1" id="tableauHeures">
      
    <?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "user";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_count = "SELECT COUNT(*) AS total_professionnels FROM professionnels";

$result_count = $conn->query($sql_count);
$total_professionnels = 0;

if ($result_count->num_rows > 0) {
    $row = $result_count->fetch_assoc();
    $total_professionnels = $row["total_professionnels"];
}

if ($total_professionnels == 0) {
    $output = "<tr><td colspan='7'>Aucun professionnel trouvé</td></tr>";
} else {
    $selected_value = isset($_POST['nombre']) ? $_POST['nombre'] : 0;
    $limit = ($selected_value > 0) ? $selected_value : $total_professionnels;

    $sql = "SELECT id, username, usertype, start_time, end_time, statut FROM professionnels ORDER BY id ASC LIMIT $limit";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = "<tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Spécialité</th>
                        <th>Heure de début</th>
                        <th>Heure de fin</th>
                        <th>Statut</th>
                        <th>Modifier</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
            $statut = ($row["statut"] == 'en ligne') ? 'En ligne' : 'Hors ligne';
            $output .= "<tr>";
            $output .= "<td>" . $row["id"] . "</td>";
            $output .= "<td>" . $row["username"] . "</td>";
            $output .= "<td>" . $row["usertype"] . "</td>";
            $output .= "<td>" . $row["start_time"] . "</td>";
            $output .= "<td>" . $row["end_time"] . "</td>";
            $output .= "<td>" . $statut . "</td>";
            $output .= "<td><a href='modifier_heurs.php?id=" . $row["id"] . "' class='modifier-link'>Modifier</a></td>";
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
</body>
</html>
