
<?php 
$servername = "localhost"; 
$usernameDB = "root"; 
$passwordDB = ""; 
$dbname = "user"; 
 
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
if (isset($_GET['id'])) { 
    $id = $_GET['id']; 
 
    if (!empty($id) && is_numeric($id)) { 
        $sql = "SELECT * FROM actes_paramedicaux WHERE id = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $id); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
 
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc(); 
        } else { 
            echo "Aucun acte trouvé avec cet identifiant."; 
        } 
 
        $stmt->close(); 
    } else { 
        echo "Identifiant de l'acte invalide."; 
    } 
} else { 
    echo "Identifiant de l'acte non spécifié."; 
} 
 
$conn->close(); 
?> 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Modifier Acte</title> 
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
    <?php if (isset($row)) : ?> 
    <div class="form-wrapper"> 
        <h2>Modifier Acte</h2> 
        <form
action="modifier_acte_script.php" method="post"> 
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
            <label for="nom">Nom de l'acte :</label> 
            <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>" required><br> 
             
            <label for="usertype">Spécialité :</label> 
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
                    while ($row_prof = $result->fetch_assoc()) { 
                        echo "<option value='" . $row_prof["usertype"] . "' " . ($row["usertype"] == $row_prof["usertype"] ? "selected" : "") . ">" . $row_prof["usertype"] . "</option>"; 
                    } 
                } 
 
                $conn->close(); 
                ?> 
            </select><br> 
             
            <input type="submit" value="Modifier"> 
        </form> 
    </div> 
    <?php endif; ?> 
    <a href="actsparamedicaux.php" class="back-to-home">Retour à la liste des actes</a> 
</body> 
</html>