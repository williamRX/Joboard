<?php
// HandleReject.php

session_start(); // Démarrer ou reprendre une session existante

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $data = json_decode(file_get_contents("php://input"));

    $applicantId = $data->applicantId;
    $adId = $data->adId;

    $sql = "UPDATE JobApplications SET Status = 'Rejected' WHERE PersonID = :applicantId AND AdID = :adId";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':applicantId', $applicantId, PDO::PARAM_INT);
    $stmt->bindParam(':adId', $adId, PDO::PARAM_INT);

    $stmt->execute();

    $response = ["success" => true];
    echo json_encode($response);
} catch (PDOException $e) {
    $response = ["success" => false, "message" => "Erreur lors de la mise à jour du statut : " . $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); // Erreur serveur
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit;
}
?>
