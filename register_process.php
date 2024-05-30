
<?php 
session_start(); 
 
// Connexion à la base de données 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "user"; // Remplacez "user" par le nom de votre base de données si différent 
 
$conn = mysqli_connect($servername, $username, $password, $database); 
 
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    $email = $_POST['email']; 
    $address = $_POST['address']; 
    $sex = $_POST['sex']; 
 
    // Type d'utilisateur (dans ce cas, "patient") 
    $user_type = "patient"; 
 
    // Insérer les données dans la table des patients 
    $sql = "INSERT INTO patients (username, password, email, address, sex) VALUES ('$username', '$password', '$email', '$address', '$sex')"; 
 
    if (mysqli_query($conn, $sql)) { 
        // Rediriger l'utilisateur vers une page de confirmation ou une autre page après l'inscription réussie 
        header('Location: register_process.php'); 
        exit(); 
    } else { 
        echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
    } 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Inscription</title> 
    <link rel="stylesheet" href="login.css"> 
</head> 
<body> 
    <div class="form-wrapper"> 
        <h2>Inscription</h2> 
        <form action="register_process.php" method="post">  
            <label for="username">Nom Complet:</label><br>      
            <input type="text" id="username" name="username" required><br> 
            <label for="password">Mot de passe:</label><br> 
            <input type="password" id="password" name="password" required><br> 
            <label for="email">Email:</label><br> 
            <input type="email" id="email" name="email" required><br> 
            <label for="address">Adresse:</label><br> 
            <input type="text" id="address" name="address"><br> 
            <label for="sex">Sexe:</label><br> 
            <select id="sex" name="sex"> 
                <option value="male">Male</option> 
                <option value="female">Female</option> 
            </select><br> 
            <button type="submit">Inscription</button> 
        </form> 
        <a href="login.php">Connexion</a> <!-- Lien vers la page de connexion --> 
    </div> 
    <a href="index.html" class="back-to-home">Retour à la page d'accueil</a> 
</body> 
</html>