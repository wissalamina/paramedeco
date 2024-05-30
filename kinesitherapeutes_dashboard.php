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

// Récupérer les informations du kinésithérapeute connecté
$email = $_SESSION['email'];
$sql = "SELECT * FROM professionnels WHERE email='$email' AND usertype='kinesitherapeute'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $kinesitherapeute = mysqli_fetch_assoc($result);
    $kinesitherapeute_id = $kinesitherapeute['id'];
}

// Récupérer le nombre total de patients associés au kinésithérapeute
$sql_total_patients = "SELECT COUNT(DISTINCT patients_id) AS total_patients FROM rendez_vous WHERE professionnels_id = '$kinesitherapeute_id'";
$result_total_patients = mysqli_query($conn, $sql_total_patients);
$total_patients = 0;
if (mysqli_num_rows($result_total_patients) == 1) {
    $row = mysqli_fetch_assoc($result_total_patients);
    $total_patients = $row['total_patients'];
}

// Récupérer le nombre de rendez-vous en attente pour le kinésithérapeute
$sql_pending_appointments = "SELECT COUNT(*) AS pending_appointments FROM rendez_vous WHERE professionnels_id = '$kinesitherapeute_id' AND statut = 'En attente'";
$result_pending_appointments = mysqli_query($conn, $sql_pending_appointments);
$pending_appointments = 0;
if (mysqli_num_rows($result_pending_appointments) == 1) {
    $row = mysqli_fetch_assoc($result_pending_appointments);
    $pending_appointments = $row['pending_appointments'];
}

// Récupérer les données sur le sexe des patients
$sql_sex_distribution = "SELECT sex, COUNT(*) AS count FROM patients 
                         WHERE id IN (SELECT DISTINCT patients_id FROM rendez_vous WHERE professionnels_id = '$kinesitherapeute_id')
                         GROUP BY sex";
$result_sex_distribution = mysqli_query($conn, $sql_sex_distribution);

$sex_distribution = [];
while ($row = mysqli_fetch_assoc($result_sex_distribution)) {
    $sex_distribution[$row['sex']] = $row['count'];
}

$male_count = isset($sex_distribution['male']) ? $sex_distribution['male'] : 0;
$female_count = isset($sex_distribution['female']) ? $sex_distribution['female'] : 0;

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Kinésithérapeute</title>
    <link rel="stylesheet" href="styl.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Styles pour le tableau de bord */
        .chart-container {
            width: 500px;
            height: 400px;
            margin: 50px auto;
        }
    </style>
</head>
<body>
<?php include 'head.php'; ?>

    <div class="main">
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers" id="total_patients"><?php echo $total_patients; ?></div>
                    <div class="cardName">Patients</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
            </div>
            
            <div class="card">
                <div>
                    <div class="numbers" id="total_appointments"><?php echo $pending_appointments; ?></div>
                    <div class="cardName">Rendez-vous en attente</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="call-outline"></ion-icon>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="sexDistributionChart"></canvas>
        </div>
    </div>
<?php include 'footer.php'; ?>

<script>
    var ctx = document.getElementById('sexDistributionChart').getContext('2d');
    var sexDistributionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Homme', 'Femme'],
            datasets: [{
                label: 'Répartition des sexes',
                data: [<?php echo $male_count; ?>, <?php echo $female_count; ?>],
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>
