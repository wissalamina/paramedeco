<?php 
include 'menu.php'; // Inclure votre menu 
include 'config.php'; // Inclure le fichier de configuration de la base de données 
 
// Vérifier si le formulaire a été soumis 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Récupérer les données du formulaire 
    $ancien_mot_de_passe = $_POST['ancien_mot_de_passe']; 
    $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe']; 
    $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe']; 
 
    // Requête SQL pour vérifier l'ancien mot de passe dans la base de données 
    $sql = "SELECT * FROM admins WHERE username = 'admin' AND password = '$ancien_mot_de_passe'"; 
    $result = mysqli_query($conn, $sql); 
 
    // Vérifier si l'ancien mot de passe est correct 
    if (mysqli_num_rows($result) == 1) { 
        // Mettre à jour le mot de passe dans la base de données 
        $update_sql = "UPDATE admins SET password = '$nouveau_mot_de_passe' WHERE username = 'admin'"; 
        if (mysqli_query($conn, $update_sql)) { 
            // Redirection vers la page de confirmation si la mise à jour est réussie 
            header("Location: confirmation.php"); 
            exit(); 
        } else { 
            echo "Erreur lors de la mise à jour du mot de passe: " . mysqli_error($conn); 
        } 
    } else { 
        echo "L'ancien mot de passe est incorrect."; 
    } 
 
    // Fermer la connexion à la base de données 
    mysqli_close($conn); 
} 
?> 
 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Changer Mot de Passe</title> 
    <link rel="stylesheet" href="styles.css"> 
    <style> 
        /* Ajoutez votre style pour le formulaire ici */ 
        .form-container { 
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background-color: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            max-width: 400px; 
            width: 100%; 
            overflow-y: auto; 
            max-height: 80vh; 
        } 
 
        .form-container h2 { 
            margin-bottom: 20px; 
        } 
 
        .form-container label { 
            display: block; 
            margin-bottom: 10px; 
        } 
 
        .form-container input[type="password"] { 
            width: 100%; 
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc; 
            margin-bottom: 15px; 
        } 
 
        .form-container input[type="submit"] { 
            background-color: #287bff; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        } 
 
        .form-container input[type="submit"]:hover { 
            background-color: #1e63c8; 
        } 
    </style> 
</head> 
<body> 
 
 
    <div class="form-container"> 
        <h2>Changer le Mot de Passe</h2> 
        <form action="changement_mot_de_passe.php" method="POST"> 
            <label for="ancien_mot_de_passe">Ancien Mot de Passe :</label> 
            <input type="password" id="ancien_mot_de_passe" name="ancien_mot_de_passe" required> 
 
            <label for="nouveau_mot_de_passe">Nouveau Mot de Passe :</label> 
            <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required> 
 
            <label for="confirmation_mot_de_passe">Confirmer le Nouveau Mot de Passe :</label> 
            <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required> 
 
            <input type="submit" value="Changer Mot de Passe"> 
        </form> 
    </div> 
</body> 
</html>