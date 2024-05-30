
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $nom = $_POST['nom']; 
    $usertype = $_POST['usertype']; 
 
    $servername = "localhost"; 
    $usernameDB = "root"; 
    $passwordDB = ""; 
    $dbname = "user"; 
 
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname); 
 
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    } 
 
    $stmt = $conn->prepare("INSERT INTO actes_paramedicaux (nom, usertype) VALUES (?, ?)"); 
    $stmt->bind_param("ss", $nom, $usertype); 
 
    if ($stmt->execute() === TRUE) { 
        echo "Acte paramédical ajouté avec succès"; 
    } else { 
        echo "Erreur: " . $stmt->error; 
    } 
 
    $stmt->close(); 
    $conn->close(); 
} 
?> 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Ajouter un acte paramédical</title> 
    <style> 
        /* Same CSS as your previous form for consistency */ 
        /* Global styles */ 
        body { 
            font-family: 'Open Sans', sans-serif; 
            background: url('background.jpg') no-repeat center center fixed; 
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
            background: rgba(255, 252, 252, 0.9); 
            border: 3px solid #00C2E8; 
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
            margin-bottom: 0px; 
            color: #333; 
            text-align: left; 
        } 
 
        input[type="text"], 
        select { 
            width: 100%; 
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
            transition: border 0.3s; 
        } 
 
        input[type="text"]:focus, 
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
</head> 
<body> 
    <div class="form-wrapper"> 
        <h2>Ajouter un acte paramédical</h2> 
        <form action="nouvel_acte.php" method="POST"> 
            <label for="nom">Nom de l'acte :</label> 
            <input type="text" id="nom" name="nom" required><br> 
 
            <label
for="usertype">Spécialité :</label> 
            <select id="usertype" name="usertype" required> 
                <?php 
                $servername = "localhost"; 
                $usernameDB = "root"; 
                $passwordDB = ""; 
                $dbname = "user"; 
 
                $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname); 
 
                if ($conn->connect_error) { 
                    die("Connection failed: " . $conn->connect_error); 
                } 
 
                // Sélectionner les spécialités uniques 
                $sql = "SELECT DISTINCT usertype FROM professionnels"; 
                $result = $conn->query($sql); 
 
                if ($result->num_rows > 0) { 
                    while ($row = $result->fetch_assoc()) { 
                        echo "<option value='" . $row["usertype"] . "'>" . $row["usertype"] . "</option>"; 
                    } 
                } 
 
                $conn->close(); 
                ?> 
            </select><br> 
             
            <input type="submit" value="Ajouter"> 
        </form> 
    </div> 
    <a href="actsparamedicaux.php" class="back-to-home">Retour à la liste des actes</a> 
</body> 
</html>