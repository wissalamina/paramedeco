<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rendez-vous</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
<div class="container">
    <div class="topbar">
        
    </div>

    <h2>Liste des rendez-vous</h2>
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
    <table border="1" id="tableauRendezvous">
    <?php
    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "user";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_count = "SELECT COUNT(*) AS total_rendezvous FROM rendez_vous";

    $result_count = $conn->query($sql_count);
    $total_rendezvous = 0;

    if ($result_count->num_rows > 0) {
        $row = $result_count->fetch_assoc();
        $total_rendezvous = $row["total_rendezvous"];
    }

    if ($total_rendezvous == 0) {
        $output = "<tr><td colspan='8'>Aucun rendez-vous trouvé</td></tr>";
    } else {
        $selected_value = isset($_POST['nombre']) ? $_POST['nombre'] : 0;
        $limit = ($selected_value > 0) ? $selected_value : $total_rendezvous;

        $sql = "SELECT r.id, p.username AS patient, prof.username AS professionnel, prof.usertype AS specialite, r.date_rendez_vous, r.heure_rendez_vous, r.acte_paramedical, r.statut
                FROM rendez_vous r
                JOIN patients p ON r.patients_id = p.id
                JOIN professionnels prof ON r.professionnels_id = prof.id
                ORDER BY r.date_rendez_vous ASC, r.heure_rendez_vous ASC
                LIMIT $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $output = "<tr>
                            <th>ID</th>
                            <th>Nom du patient</th>
                            <th>Nom du professionnel</th>
                            <th>Spécialité demandée</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Acte paramédical</th>
                            <th>Statut</th>
                        </tr>";

            while ($row = $result->fetch_assoc()) {
                $output .= "<tr>";
                $output .= "<td>" . $row["id"] . "</td>";
                $output .= "<td>" . $row["patient"] . "</td>";
                $output .= "<td>" . $row["professionnel"] . "</td>";
                $output .= "<td>" . $row["specialite"] . "</td>";
                $output .= "<td>" . $row["date_rendez_vous"] . "</td>";
                $output .= "<td>" . $row["heure_rendez_vous"] . "</td>";
                $output .= "<td>" . $row["acte_paramedical"] . "</td>";
                $output .= "<td>" . $row["statut"] . "</td>";
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
