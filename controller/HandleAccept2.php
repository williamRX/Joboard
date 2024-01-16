<?php
// HandleAccept.php

session_start(); // Démarrer ou reprendre une session existante

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $data = json_decode(file_get_contents("php://input"));

    $email = $data->email;
    $adId = $data->adId;

    // Préparation de la requête SQL pour mettre à jour le statut en "Accepté"
    $sql = "UPDATE JobApplications SET Status = 'Accepted' WHERE Email = :email AND AdID = :adId";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':adId', $adId, PDO::PARAM_INT);
    $stmt->execute();

    $response = ["success" => true];
    echo json_encode($response);
} catch (PDOException $e) {
    $response = ["success" => false, "message" => "Erreur lors de la mise à jour du statut : " . $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}
?>
