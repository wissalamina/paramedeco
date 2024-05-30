<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe médicale</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
<div class="container">
    <div class="topbar">
        <!-- Bouton "AJOUTER" -->
        <a href="nouveau_utilisateur.php" class="add-button">Ajouter</a>
    </div>

    <h2>Liste des professionnels de sante</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre"></label>
        <input type="submit" value="Afficher" name="submit" class="show-button">
        <select name="nombre" id="nombre" class="select-box">
            <option value="0" <?php if (isset($_POST['nombre']) && $_POST['nombre'] == 0) echo 'selected'; ?>>Tout</option>
            <?php
            // Générer une liste déroulante avec 50 nombres
            for ($i = 1; $i <= 50; $i++) {
                echo "<option value='$i' " . (isset($_POST['nombre']) && $_POST['nombre'] == $i ? 'selected' : '') . ">$i</option>";
            }
            ?>
        </select>
    </form>
    <table border="1" id="tableauMembres">
      
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

    // Requête SQL pour compter le nombre total de professionnels
    $sql_count = "SELECT COUNT(*) AS total_members FROM professionnels";

    $result_count = $conn->query($sql_count);
    $total_members = 0;

    if ($result_count->num_rows > 0) {
        $row = $result_count->fetch_assoc();
        $total_members = $row["total_members"];
    }

    // Si le nombre total est 0, afficher un message
    if ($total_members == 0) {
        $output = "<tr><td colspan='8'>Aucun membre trouvé</td></tr>";
    } else {
        // Récupérer la valeur sélectionnée dans la liste déroulante
        $selected_value = isset($_POST['nombre']) ? $_POST['nombre'] : 0;

        // Définir la limite en fonction de la valeur sélectionnée
        $limit = ($selected_value > 0) ? $selected_value : $total_members;

        // Requête SQL pour récupérer les professionnels en fonction de la limite
        $sql = "SELECT id, username, email, address, sex, phone, usertype 
                FROM professionnels 
                ORDER BY id DESC
                LIMIT $limit";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Construire le contenu du tableau
            $output = "<tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Sexe</th>
                            <th>Téléphone</th>
                            <th>Specialite</th>
                            <th>Supprimer</th>
                            <th>Modifier</th>
                        </tr>";

            while ($row = $result->fetch_assoc()) {
                $output .= "<tr>";
                $output .= "<td>" . $row["id"] . "</td>";
                $output .= "<td>" . $row["username"] . "</td>";
                $output .= "<td>" . $row["email"] . "</td>";
                $output .= "<td>" . $row["address"] . "</td>";
                $output .= "<td>" . $row["sex"] . "</td>";
                $output .= "<td>" . $row["phone"] . "</td>";
                $output .= "<td>" . $row["usertype"] . "</td>";
                $output .= "<td><a href='#' onclick='confirmDelete(\"" . $row["username"] . "\")' class='delete-button'>Supprimer</a></td>";
                $output .= "<td><a href='modifier_membre.php?id=" . $row["id"] . "' class='modifier-link'>Modifier</a></td>";
                $output .= "</tr>";
            }
        }
    }

    echo $output;

    $conn->close();
    ?>
    </table>
</div>
<script>
    $(document).ready(function(){
        // Charger les données initiales du tableau
        updateTable();

        // Écouter les changements dans la liste déroulante
        $('#nombre').change(function(){
            // Mettre à jour le tableau lorsque la sélection change
            updateTable();
        });

        // Fonction pour mettre à jour le tableau en fonction du nombre sélectionné
        function updateTable() {
            var nombre = $('#nombre').val();
            $.ajax({
                type: 'POST',
                url: 'fetch_data.php', // Le fichier PHP qui récupère les données
                data: { nombre: nombre },
                success: function(response) {
                    $('#tableauMembres').html(response);
                }
            });
        }
    });

    // Fonction pour soumettre le formulaire
    function submitForm() {
        document.querySelector("form").submit();
    }

    // Appeler la fonction lors du chargement de la page
    window.onload = submitForm;

    function confirmDelete(username) {
        if (confirm("Voulez-vous vraiment supprimer ce membre ?")) {
            window.location.href = 'supprimer_membre.php?username=' + username;
        } else {
            return false; // Empêche le lien de se comporter comme un lien normal
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
