<?php
session_start();

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

$usertype = '';
if (mysqli_num_rows($result) == 1) {
    $professionnel = mysqli_fetch_assoc($result);
    $usertype = $professionnel['usertype'];
}

// Handle updating an act
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_act'])) {
    $act_id = $_POST['act_id'];
    $nom = $_POST['nom'];
    $sql = "UPDATE actes_paramedicaux SET nom='$nom' WHERE id='$act_id' AND usertype='$usertype'";
    mysqli_query($conn, $sql);
}

// Fetch acts
$sql = "SELECT * FROM actes_paramedicaux WHERE usertype='$usertype'";
$acts_result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les actes paramédicaux</title>
    <link rel="stylesheet" href="sty.css">
    <style>
        
    /* Styles pour le tableau */
    table {
        margin: 130px auto; /* Centrer le tableau */
        border-collapse: collapse; /* Éliminer l'espace entre les bordures des cellules */
        width: 60%; /* Ajuster la largeur selon vos besoins */
        background-color: #f9f9f9; /* Couleur de fond des cellules */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère pour le tableau */
        left: 45%;
    }

    table th, table td {
        padding: 8px; /* Ajouter un espace intérieur aux cellules */
        border: 1px solid #ddd; /* Bordure des cellules */
        text-align: left; /* Alignement du texte à gauche */
    }

    table th {
        background-color: #0f117e; 
        color: white; /* Couleur du texte des en-têtes */
        font-weight: bold; /* Texte en gras */
    }

    table tr:hover {
        background-color: #f1f1f1; /* Changer la couleur de fond au survol */
    }

    h2 {
        text-align: left; /* Aligner le texte à gauche */
        padding: 50px; /* Espace intérieur */
        margin: 50px auto; /* Espace extérieur et centrer */
        padding-left: 0px; /* Espace intérieur à gauche */
        width: 60%; /* Réduire la largeur pour que le texte soit plus à gauche */
        color: #0f117e;
    }
</style>

</head>
<body>
<?php include 'head.php'; ?>
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    
    </div>

    <h2>Les actes paramédicaux</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
        </tr>
        <?php
        if (mysqli_num_rows($acts_result) > 0) {
            while ($row = mysqli_fetch_assoc($acts_result)) {
                echo "<tr>";
                echo "<td><span class='act-id'>" . $row["id"] . "</span></td>";
                echo "<td><span class='act-nom'>" . $row["nom"] . "</span></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Aucun acte paramédical trouvé</td></tr>";
        }
        ?>
    </table>
</div>

<script>
    function toggleMenu() {
        const navigation = document.querySelector('.navigation');
        const main = document.querySelector('.main');
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }

    document.querySelector('.toggle').addEventListener('click', toggleMenu);
</script>
</body>
</html>
