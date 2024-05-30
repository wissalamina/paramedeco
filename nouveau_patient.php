<?php 
// Traitement du formulaire 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Récupération des données du formulaire 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    $email = $_POST['email']; 
    $address = $_POST['address']; 
    $sex = $_POST['sex']; 
    $phone = $_POST['phone']; 
 
    // Connexion à la base de données et insertion des données 
    $servername = "localhost"; 
    $usernameDB = "root"; 
    $passwordDB = ""; 
    $dbname = "user"; 
 
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname); 
 
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    } 
 
    // Insérer les données dans la table des patients 
    $sql = "INSERT INTO patients (username, password, email, address, sex, phone) 
            VALUES ('$username', '$password', '$email', '$address', '$sex', '$phone')"; 
 
    if ($conn->query($sql) === TRUE) { 
        echo "Patient ajouté avec succès"; 
    } else { 
        echo "Erreur: " . $sql . "<br>" . $conn->error; 
    } 
 
    $conn->close(); 
} 
?> 
 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Ajouter un patient</title> 
    <link rel="stylesheet" href=""> 
</head> 
<body> 
    <div class="form-wrapper"> 
        <h2>Ajouter un patient</h2> 
        <form action="nouveau_patient.php" method="POST"> 
            <label for="username">Nom d'utilisateur :</label> 
            <input type="text" id="username" name="username" required><br> 
             
            <label for="password">Mot de passe :</label> 
            <input type="password" id="password" name="password" required><br> 
             
            <label for="email">Email :</label> 
            <input type="email" id="email" name="email" required><br> 
             
            <label for="address">Adresse :</label> 
            <input type="text" id="address" name="address" required><br> 
             
            <label for="sex">Sexe :</label> 
            <input type="radio" id="male" name="sex" value="male" required> 
            <label for="male">Homme</label> 
            <input type="radio" id="female" name="sex" value="female" required> 
            <label for="female">Femme</label><br> 
 
            <label for="phone">Numéro de téléphone :</label> 
            <input type="text" id="phone" name="phone" required><br> 
             
            <input type="submit" value="Ajouter"> 
        </form> 
    </div> 
    <a href="patients.php" class="back-to-home">Retour à la page d'admin</a> 
    <style> 
        /* Global styles */ 
body { 
    font-family: 'Open Sans', sans-serif; 
    background: url('background.jpg') no-repeat center center fixed; 
    background-size: cover; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    height: 120vh; 
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
    border: 3px solid #00C2E8; /* Light blue border */ 
    border-radius: 5px; 
    padding: 25px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    width: 50%; 
    max-width: 450px; 
    text-align: center; 
    position: relative; 
} 
 
label { 
    display: block; 
    font-weight: bold; 
    margin-bottom: 0px; 
    color: #333; 
    text-align: left; 
} 
 
input[type="text"], 
input[type="password"], 
input[type="email"], 
input[type="radio"], 
select { 
    width: 100%; 
    padding: 10px; 
    margin-bottom: 20px; 
    border: 1px solid #ddd; 
    border-radius: 4px; 
    box-sizing: border-box; 
    transition: border 0.3s; 
} 
 
input[type="radio"] { 
    width: auto; 
    margin-right: 5px; 
} 
 
input[type="text"]:focus, 
input[type="password"]:focus, 
input[type="email"]:focus, 
select:focus { 
    border-color: #00C2E8; 
} 
 
input[type="submit"] { 
    background-color: #00C2E8;
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
    background-color: #009bcf; 
} 
 
a { 
    display: block; 
    margin-top: 20px; 
    color: #00C2E8; 
    text-decoration: none; 
    font-weight: bold; 
    transition: color 0.3s; 
} 
 
a:hover { 
    color: #009bcf; 
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
    color: #fff; 
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
</body> 
</html>