<?php
$host = 'localhost'; 
$dbname = 'JobAdvertisements'; 
$user = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    session_start();
    if (!isset($_SESSION['PersonID'])) {
        echo json_encode(['applied' => false]);
        exit;
    }

    $adID = $_GET['adID'];
    $personID = $_SESSION['PersonID'];

    $query = "SELECT COUNT(*) FROM JobApplications WHERE AdID = ? AND PersonID = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $adID, PDO::PARAM_INT);
    $stmt->bindParam(2, $personID, PDO::PARAM_INT);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // L'utilisateur a déjà postulé pour cette annonce
        echo json_encode(['applied' => true]);
    } else {
        // L'utilisateur n'a pas encore postulé
        echo json_encode(['applied' => false]);
    }
} catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['applied' => false, 'error' => $e->getMessage()]); 
    exit;
}
?>
