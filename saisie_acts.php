
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
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $description = $_POST['description']; 
    $date = date('Y-m-d'); // Obtenir la date actuelle 
 
    $insert_sql = "INSERT INTO acts_paramedicaux (usertype, description, date) VALUES ('$usertype', '$description', '$date')"; 
    if (mysqli_query($conn, $insert_sql)) { 
        echo ""; 
    } else { 
        echo "Erreur : " . mysqli_error($conn); 
    } 
} 
 
mysqli_close($conn); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Saisie des actes paramédicaux</title> 
    <style> 
        /* Global styles */ 
        body { 
            font-family: 'Open Sans', sans-serif; 
            background: url('backgroundb.jpg') no-repeat center center fixed; 
            background-size: cover; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        } 
 
        h2 { 
            color: #333; 
            margin-bottom: 20px; 
            text-align: center; 
            font-size: 2em; 
        } 
 
        /* Form wrapper */  
        .form-wrapper { 
            background: rgba(255, 252, 252, 0.9); /* White background with 90% opacity */ 
            border: 3px solid #0f117e; /* Green border */ 
            border-radius: 5px; 
            padding: 25px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            width: 50%; 
            max-width: 400px; 
            text-align: center; 
            position: relative; 
        } 
 
        label { 
            display: block; 
            font-weight: bold; 
            margin-bottom: 10px; 
            color: #333; 
            text-align: left; 
        } 
 
        input[type="text"] { 
            width: 100%; 
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
            transition: border 0.3s; 
        } 
 
        input[type="text"]:focus { 
            border-color: #0f117e; 
        } 
 
        input[type="submit"] { 
            background-color: #0f117e; 
            color: white; 
            border: none; 
            padding: 15px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px; 
            transition: background 0.3s; 
            width: 100%; 
        } 
 
        input[type="submit"]:hover { 
            background-color: #595bf7; 
        } 
 
        a { 
            display: block; 
            margin-top: 20px; 
            color: #0f117e; 
            text-decoration: none; 
            font-weight: bold; 
            transition: color 0.3s; 
        } 
 
        a:hover { 
            color: #595bf7;  
        } 
 
        p { 
            color: red; 
            text-align: center; 
            margin-top: 20px; 
        } 
 
        .back-to-home { 
            position: absolute; 
            top: 20px; 
            left: 20px; 
            color: #595bf7; 
            font-weight: bold; 
            font-size: 1em; 
            background: rgba(0, 0, 0, 0.1); 
            padding: 10px 15px; 
            border-radius: 4px; 
            transition: background 0.3s; 
        } 
 
        .back-to-home:hover { 
            background: rgba(0, 0, 0, 0.3);
} 
    </style> 
</head> 
<body> 
    <div class="form-wrapper"> 
        <h2>Saisie des actes paramédicaux</h2> 
        <form method="post" action="saisie_acts.php"> 
            <label for="description">Description de l'acte</label> 
            <input type="text" id="description" name="description" required> 
 
            <input type="submit" value="Ajouter l'acte"> 
        </form> 
        <a href="acts_paramedicaux.php">Voir les actes paramédicaux</a> 
    </div> 
</body> 
</html>