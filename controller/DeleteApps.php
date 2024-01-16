<?php

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $applicationID = $_GET['appID']; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->beginTransaction();

        // Supprimez l'application
        $deleteApplication = $pdo->prepare("DELETE FROM JobApplications WHERE ApplicationID = :applicationID");
        $deleteApplication->bindParam(':applicationID', $applicationID);
        $deleteApplication->execute();

        $pdo->commit();
        $response = ['success' => true];
    } catch (PDOException $e) {
        $pdo->rollBack();
        $response = ['success' => false, 'error' => $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}

?>
