<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "user";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $tables = ['admins', 'patients', 'receptionists', 'professionnels'];
    $user_type = '';
    $redirect_url = '';

    foreach ($tables as $table) {
        if ($table == 'professionnels') {
            $sql = "SELECT * FROM $table WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['email'] = $row['email'];
                $user_type = $row['usertype'];

                // Mettre à jour le statut à "en ligne"
                $update_status_sql = "UPDATE professionnels SET statut='en ligne' WHERE email='$email'";
                mysqli_query($conn, $update_status_sql);

                break;
            }
        } else {
            $sql = "SELECT * FROM $table WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['email'] = $row['email'];
                $user_type = $table;

                // Mettre à jour le statut à "en ligne" si l'utilisateur est un patient
                if ($user_type == 'patients') {
                    $update_status_sql = "UPDATE patients SET statut='en ligne' WHERE email='$email'";
                    mysqli_query($conn, $update_status_sql);
                }
                break;
            }
        }
    }

    if ($user_type !== '') {
        switch ($user_type) {
            case 'admins':
                $redirect_url = 'admin.html';
                break;
            case 'patients':
                $redirect_url = 'patient_dashboard.html';
                break;
            case 'receptionists':
                $redirect_url = 'receptionist_dashboard.php';
                break;
            case 'infirmier':
                $redirect_url = 'infirmier_dashboard.php';
                break;
            case 'kinesitherapeute':
                $redirect_url = 'kinesitherapeutes_dashboard.php';
                break;
            case 'ergotherapeute':
                $redirect_url = 'ergotherapeutes_dashboard.php';
                break;
            case 'ats':
                $redirect_url = 'ats_dashboard.php';
                break;
        }
        header('Location: ' . $redirect_url);
        exit();
    } else {
        $error = "Email ou mot de passe invalide";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Connexion</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Mot de passe:</label><br>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Connexion</button>
        </form>
        <a href="register_process.php">Inscription</a>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
    <a href="index.html" class="back-to-home">Retour à la page d'accueil</a>
</body>
</html>
