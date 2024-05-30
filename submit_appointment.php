<?php
// Inclure la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "User";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $specialty = $_POST['specialty'];
    $acts = $_POST['act'];

    // Récupérer l'ID du patient basé sur l'email
    $patient_id_query = "SELECT id FROM patients WHERE email = ?";
    $stmt = $conn->prepare($patient_id_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($patient_id);
    $stmt->fetch();
    $stmt->close();

    if ($patient_id) {
        // Récupérer les professionnels disponibles pour la spécialité et l'heure demandée
        $professionnelle_query = "
            SELECT p.id 
            FROM professionnels p 
            LEFT JOIN rendez_vous r ON p.id = r.professionnels_id AND r.date_rendez_vous = ? AND r.heure_rendez_vous = ?
            WHERE p.UserType = ? AND (
                (p.start_time <= ? AND p.end_time >= ?) OR
                (p.start_time <= ? AND p.end_time < p.start_time) OR
                (p.end_time >= ? AND p.end_time < p.start_time)
            ) AND r.id IS NULL
        ";
        $stmt = $conn->prepare($professionnelle_query);
        $stmt->bind_param("sssssss", $date, $time, $specialty, $time, $time, $time, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        $professionnelle_ids = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (count($professionnelle_ids) > 0) {
            // Choisir un professionnel aléatoirement parmi ceux disponibles
            $random_index = array_rand($professionnelle_ids);
            $professionnelle_id = $professionnelle_ids[$random_index]['id'];

            // Insérer les données du rendez-vous dans la table rendez_vous
            $statut = 'En attente'; // Par exemple, statut initial
            $acts_list = implode(", ", $acts); // Convertir les actes en une chaîne de caractères séparée par des virgules
            $insert_query = "INSERT INTO rendez_vous (patients_id, professionnels_id, date_rendez_vous, heure_rendez_vous, acte_paramedical, statut, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("iisssss", $patient_id, $professionnelle_id, $date, $time, $acts_list, $statut, $address);

            if ($stmt->execute()) {
                echo "Rendez-vous enregistré avec succès!";
            } else {
                echo "Erreur: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Aucun professionnel disponible pour la spécialité sélectionnée à l'heure demandée.";
        }
    } else {
        echo "Email du patient invalide. Veuillez entrer un email valide.";
    }

    $conn->close();
}
?>
