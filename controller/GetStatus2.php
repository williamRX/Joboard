<?php
session_start(); // Démarrer ou reprendre une session existante

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $email = $_GET['Email'];
    $adId = $_GET['adId'];

    $sql = "SELECT Status FROM JobApplications WHERE Email = :email AND AdID = :adId";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adId', $adId);

    $stmt->execute();

    $status = $stmt->fetchColumn();

    echo json_encode(['status' => $status]);
} catch (PDOException $e) {
    $response = ["success" => false, "message" => "Erreur lors de la récupération du statut : " . $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); // Erreur serveur
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}
?>
