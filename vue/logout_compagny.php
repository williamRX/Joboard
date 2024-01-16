<?php
session_start();

if (!isset($_SESSION['CompanyID'])) {
    // Redirigez l'utilisateur vers la page de connexion si la session n'existe pas
    header("Location:joboard_login.php");
    exit();
}

// Supprimez toutes les variables de session
$_SESSION = array();

// Détruisez complètement la session
session_destroy();

// Redirigez l'utilisateur vers une autre page (par exemple, la page de connexion)
header("Location:joboard_login.php");
exit();
?>
