<?php

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $advertisementID = $_GET['adID'];

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        
        $pdo->beginTransaction();


        // Supprime les candidatures associées à cette annonce
        $deleteApplications = $pdo->prepare("DELETE FROM JobApplications WHERE AdID = :advertisementID");
        $deleteApplications->bindParam(':advertisementID', $advertisementID);
        $deleteApplications->execute();

        // Supprime l'annonce
        $deleteAdvertisement = $pdo->prepare("DELETE FROM Advertisements WHERE AdID = :advertisementID");
        $deleteAdvertisement->bindParam(':advertisementID', $advertisementID);
        $deleteAdvertisement->execute();

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
