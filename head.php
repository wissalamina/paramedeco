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
$sql = "SELECT usertype FROM professionnels WHERE email='$email'";
$result = mysqli_query($conn, $sql);

$usertype = '';
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $usertype = $row['usertype'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="sstyl.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="bag-add-outline"></ion-icon></span>
                        <span class="title">Sihati Dom</span>
                    </a>
                </li>
                <li>
                    <a id="dashboard-link" href="#">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="rendez_vous.php">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <span class="title">Rendez-vous</span>
                    </a>
                </li>
                <li>
                    <a href="acts_paramedicaux.php">
                        <span class="icon"><ion-icon name="bag-add-outline"></ion-icon></span>
                        <span class="title">Les acts paramedicaux</span>
                    </a>
                </li>
                <li>
                    <a href="parametres.php">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Parametres</span>
                    </a>
                </li>
                <li>
                    <a href="logoutp.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Se deconnecter</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        // Définir le type de professionnel à partir de PHP
        const userType = "<?php echo $usertype; ?>";

        // Définir le lien du tableau de bord en fonction du type de professionnel
        const dashboardLink = document.getElementById('dashboard-link');
        switch (userType) {
            case 'infirmier':
                dashboardLink.href = 'infirmier_dashboard.php';
                break;
            case 'ats':
                dashboardLink.href = 'ats_dashboard.php';
                break;
            case 'ergotherapeute':
                dashboardLink.href = 'ergotherapeutes_dashboard.php';
                break;
            case 'kinesitherapeute':
                dashboardLink.href = 'kinesitherapeutes_dashboard.php';
                break;
            default:
                dashboardLink.href = '#';
                break;
        }
    </script>
</body>
</html>
