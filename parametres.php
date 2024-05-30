
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
 
if (mysqli_num_rows($result) == 1) { 
    $professionnel = mysqli_fetch_assoc($result); 
    $nom = $professionnel['username']; 
    $specialite = $professionnel['usertype']; 
    $heure_debut = $professionnel['start_time']; 
    $heure_fin = $professionnel['end_time']; 
} 
 
// Handle updating email and password 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) { 
    $new_email = $_POST['email']; 
    $new_password = $_POST['password']; 
 
    $update_sql = "UPDATE professionnels SET email='$new_email', password='$new_password' WHERE email='$email'"; 
    if (mysqli_query($conn, $update_sql)) { 
        $_SESSION['email'] = $new_email; // Mettre à jour la session avec le nouvel email 
        echo ""; 
    } else { 
        echo "Erreur : " . mysqli_error($conn); 
    } 
} 
 
mysqli_close($conn); 
?> 
 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Paramètres du compte</title> 
    <style> 
        body { 
            font-family: 'Open Sans', sans-serif; 
            background-size: cover; 
            display: flex; 
            height: 100vh; 
            margin: 0; 
        } 
 
        .container { 
            display: flex; 
            width: 100%; 
        } 
 
        .navigation { 
            width: 20%; 
            background-color: #333; 
        } 
 
        .main { 
            width: 80%; 
            padding: 20px; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        } 
 
        .form-wrapper { 
            background: rgba(0, 0, 0, 0.1); /* Fond transparent */ 
            border: 3px solid #0f117e; /* Bordure verte */ 
            border-radius: 5px; 
            padding: 25px; 
            width: 300%; 
            max-width: 500px; 
            text-align: left; 
            color: black; 
        } 
 
        h2 { 
            text-align: left; 
            padding: 5px; 
            margin: 30px auto; 
            padding-left: 0px; 
            width: 60%; 
            color: #0f117e; 
            font-family: 'Arial', sans-serif; 
            font-weight: bold; 
        } 
 
        label, p { 
            display: block; 
            font-weight: bold; 
            margin-bottom: 10px; 
            color: black; 
        } 
 
        input[type="text"], 
        input[type="email"], 
        input[type="password"], 
        input[type="time"] { 
            width: 100%; 
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
            transition: border 0.3s; 
        } 
 
        input[type="text"]:focus, 
        input[type="email"]:focus, 
        input[type="password"]:focus, 
        input[type="time"]:focus { 
            border-color: #0f117e; 
        } 
 
        .edit-mode input[type="email"], 
        .edit-mode input[type="password"] { 
            border: 1px solid #0f117e; 
            background: white; 
            color: #333; 
        } 
 
        .edit-mode input[type="submit"] { 
            display: block; 
        } 
 
        .edit-mode .edit-btn { 
            display: none; 
        } 
 
        input[type="submit"] { 
            background-color: #0f117e; 
            color: white; 
            border: none; 
            padding: 15px; 
            border-radius: 4px; 
            cursor:
pointer; 
            font-size: 16px; 
            transition: background 0.3s; 
            width: 100%; 
            display: none; 
        } 
 
        input[type="submit"]:hover { 
            background-color: #388E3C; 
        } 
 
        .edit-btn { 
            background-color: #0f117e; 
            color: white; 
            border: none; 
            padding: 15px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 20px; 
            transition: background 0.3s; 
            width: 100%; 
        } 
 
        .edit-btn:hover { 
            background-color: blue; 
        } 
    </style> 
</head> 
<body> 
    <?php include 'head.php'; ?> 
    <div class="main"> 
        <div class="form-wrapper"> 
            <h2>Paramètres du compte</h2> 
            <form method="post" action="parametres.php" id="parametres-form"> 
                <p>Nom : <?php echo $nom; ?></p> 
                <p>Email : <input type="email" name="email" value="<?php echo $email; ?>" readonly></p> 
                <p>Spécialité : <?php echo $specialite; ?></p> 
                <p>Heure de début : <?php echo $heure_debut; ?></p> 
                <p>Heure de fin : <?php echo $heure_fin; ?></p> 
                <p>Mot de passe : <input type="password" name="password" value="********" readonly></p> 
                <input type="submit" name="update_info" value="Sauvegarder"> 
                <button type="button" class="edit-btn" onclick="enableEditMode()">Modifier</button> 
            </form> 
        </div> 
    </div> 
 
    <script> 
        function enableEditMode() { 
            const form = document.getElementById('parametres-form'); 
            form.classList.add('edit-mode'); 
            const emailField = form.querySelector('input[name="email"]'); 
            const passwordField = form.querySelector('input[name="password"]'); 
            emailField.removeAttribute('readonly'); 
            passwordField.removeAttribute('readonly'); 
            passwordField.value = ''; 
        } 
    </script> 
</body> 
</html>