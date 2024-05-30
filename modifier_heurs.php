
<?php 
// Connexion à la base de données 
$servername = "localhost"; 
$usernameDB = "root"; 
$passwordDB = ""; 
$dbname = "user"; 
 
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
// Vérifier si l'identifiant du professionnel est passé dans l'URL 
if (isset($_GET['id'])) { 
    // Récupérer l'identifiant du professionnel depuis l'URL 
    $id = $_GET['id']; 
 
    // Assurez-vous que l'identifiant est valide 
    if (!empty($id) && is_numeric($id)) { 
        // Préparer la requête SQL pour récupérer les informations du professionnel 
        $sql = "SELECT * FROM professionnels WHERE id = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $id); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
 
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc(); 
            // Les informations du professionnel sont stockées dans $row 
        } else { 
            echo "Aucun professionnel trouvé avec cet identifiant."; 
        } 
 
        $stmt->close(); 
    } else { 
        echo "Identifiant du professionnel invalide."; 
    } 
} else { 
    echo "Identifiant du professionnel non spécifié."; 
} 
 
$conn->close(); 
?> 
 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Modifier Heure de Travail</title> 
    <style> 
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
            background: rgba(255, 252, 252, 0.9); /* White background with 90% opacity */ 
            border: 3px solid #00C2E8; /* Light blue border */ 
            border-radius: 5px; 
            padding: 25px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            width: 50%; 
            max-width: 350px; 
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
        input[type="email"], 
        input[type="time"], 
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
        input[type="email"]:focus, 
        input[type="time"]:focus, 
        select:focus { 
            border-color: #00C2E8; 
        } 
 
        button { 
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
 
        button:hover { 
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
        <h2>Modifier Heure de Travail</h2> 
        <form action="modifierheures_script.php" method="post"> 
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
            <label for="username">Nom d'utilisateur:</label> 
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required readonly><br><br> 
            <label for="usertype">Spécialité:</label> 
            <select id="usertype" name="usertype" required disabled> 
                <option value="infirmier" <?php echo ($row['usertype'] == 'infirmier') ? 'selected' : ''; ?>>Infirmier</option> 
                <option value="ergotherapeute" <?php echo ($row['usertype'] == 'ergotherapeute') ? 'selected' : ''; ?>>Ergothérapeute</option> 
                <option value="kinesitherapeute" <?php echo ($row['usertype'] == 'kinesitherapeute') ? 'selected' : ''; ?>>Kinésithérapeute</option> 
                <option value="ats" <?php echo ($row['usertype'] == 'ats') ? 'selected' : ''; ?>>ATS</option> 
            </select><br><br> 
            <label for="start_time">Heure de début:</label> 
            <input type="time" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" required><br><br> 
            <label for="end_time">Heure de fin:</label> 
            <input type="time" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" required><br><br> 
            <button type="submit">Modifier</button> 
        </form> 
    </div> 
    <?php endif; ?> 
    <a href="equipe_medical.php" class="back-to-home">Retour à la page d'admin</a> 
 
</body> 
</html>