<?php include 'head.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "user";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer les informations du professionnel connecté
$email = $_SESSION['email'];
$sql = "SELECT * FROM professionnels WHERE email='$email'";
$result = mysqli_query($conn, $sql);

$professionnel_id = '';
if (mysqli_num_rows($result) == 1) {
    $professionnel = mysqli_fetch_assoc($result);
    $professionnel_id = $professionnel['id'];
} else {
    die("Aucun professionnel trouvé.");
}

// Handle updating a status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $rendez_vous_id = $_POST['rendez_vous_id'];
    $statut = $_POST['statut'];
    $sql = "UPDATE rendez_vous SET statut='$statut' WHERE id='$rendez_vous_id'";
    if (!mysqli_query($conn, $sql)) {
        echo "Erreur lors de la mise à jour du statut : " . mysqli_error($conn);
    }
}

// Fetch appointments for the logged-in professional
$sql = "SELECT rv.id, p.username AS patient, p.email, p.address, rv.acte_paramedical, rv.date_rendez_vous, rv.heure_rendez_vous, rv.statut 
        FROM rendez_vous rv 
        JOIN patients p ON rv.patients_id = p.id 
        WHERE rv.professionnels_id = '$professionnel_id'
        ORDER BY rv.date_rendez_vous, rv.heure_rendez_vous";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Erreur lors de la récupération des rendez-vous : " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rendez-vous</title>
    <style>
        /* Styles pour le tableau */
        table {
            margin: 180px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #0f117e;
            color: white;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td form {
            display: inline;
        }

        .edit-form input[type="submit"] {
            margin: 0px 0;
            padding: 0px 1px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-form select {
            padding: 1px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .edit-form {
            display: inline;
        }

        h2 {
            text-align: left;
            padding: 50px;
            margin: 30px auto;
            padding-left: 0px;
            width: 60%;
            color: #0f117e;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="main">
    <h2>Liste des rendez-vous</h2>
    <table border="1">
        <tr>
            <th>Nom du patient</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Acte paramédical demandé</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Statut</th>
            <th>Modifier</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["patient"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["acte_paramedical"] . "</td>";
                echo "<td>" . $row["date_rendez_vous"] . "</td>";
                echo "<td>" . $row["heure_rendez_vous"] . "</td>";
                echo "<td>" . $row["statut"] . "</td>";
                echo "<td>
                        <form class='edit-form' method='post' action='rendez_vous.php'>
                            <input type='hidden' name='rendez_vous_id' value='" . $row["id"] . "'>
                            <select name='statut'>
                                <option value='En attente'" . ($row["statut"] == 'En attente' ? ' selected' : '') . ">En attente</option>
                                <option value='Confirmé'" . ($row["statut"] == 'Confirmé' ? ' selected' : '') . ">Confirmé</option>
                                <option value='Annulé'" . ($row["statut"] == 'Annulé' ? ' selected' : '') . ">Annulé</option>
                                <option value='Terminé'" . ($row["statut"] == 'Terminé' ? ' selected' : '') . ">Terminé</option>
                            </select>
                            <input type='submit' name='update_status' value='Modifier'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun rendez-vous trouvé</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
