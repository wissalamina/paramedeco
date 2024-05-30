<?php
// Démarrez la session
session_start();

// Détruisez toutes les données de session
session_destroy();

// Redirigez l'utilisateur vers la page de connexion ou toute autre page appropriée
header("Location: login.php");
exit;
?>
