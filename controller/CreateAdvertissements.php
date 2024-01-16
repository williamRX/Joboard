<?php
session_start(); // Démarrer ou reprendre une session existante

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $data = json_decode(file_get_contents("php://input"));

    // Extraction des données
    $Title = $data->Title;
    $Description = $data->Description;
    $WorkType = $data->WorkType;
    $WorkingTime = $data->WorkingTime;
    $Wages = $data->Wages;
    $PostedDate = $data->PostedDate;

    // Récupération du CompanyID à partir de la session
    $CompanyID = $_SESSION['CompanyID'];

    $sql = "INSERT INTO Advertisements (Title, Description, WorkType, WorkingTime, Wages, PostedDate, CompanyID) VALUES (:Title, :Description, :WorkType, :WorkingTime, :Wages, :PostedDate, :CompanyID)";

    // Préparation de la requête SQL avec PDO
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':Title', $Title);
    $stmt->bindParam(':Description', $Description);
    $stmt->bindParam(':WorkType', $WorkType);
    $stmt->bindParam(':WorkingTime', $WorkingTime);
    $stmt->bindParam(':Wages', $Wages);
    $stmt->bindParam(':PostedDate', $PostedDate);
    $stmt->bindParam(':CompanyID', $CompanyID);

    $stmt->execute();

    $response = ["success" => true, "message" => "Annonce créée"];
    echo json_encode($response);
} catch (PDOException $e) {
    $response = ["success" => false, "message" => "Erreur lors de la création de l'annonce : " . $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}
?>

