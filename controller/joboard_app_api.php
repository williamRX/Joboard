<?php
$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';
session_start();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $personID = $_SESSION['PersonID']; 

    $sql = "SELECT j.ApplicationID, j.AdID, j.PersonID, j.AppliedDate, j.Status, j.Notes, a.Title, a.Description
            FROM JobApplications j
            JOIN Advertisements a ON j.AdID = a.AdID
            WHERE j.PersonID = :personID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':personID', $personID, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $applications = json_encode($results);

    echo $applications;

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur de base de données : " . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500); // Erreur serveur
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}

?>
