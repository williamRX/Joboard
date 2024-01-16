<?php
$host = 'localhost'; 
$dbname = 'JobAdvertisements'; 
$user = 'root'; 
$password = ''; 

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Récupération des données POST envoyées par JavaScript
    $data = json_decode(file_get_contents("php://input"));

    // Extraction des données
    $CompanyName = $data->CompanyName;
    $Location = $data->Location;
    $Industry = $data->Industry;
    $RH_mail = $data->RH_mail;
    $RH_password = $data->RH_password;
    $RH_identifiant = $data->RH_identifiant;

$sql = "INSERT INTO Companies (CompanyName, Location, Industry, RH_mail, RH_password, RH_identifiant) VALUES (:CompanyName, :Location, :Industry, :RH_mail, :RH_password, :RH_identifiant)";

// Préparation de la requête SQL avec PDO
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':CompanyName', $CompanyName);
$stmt->bindParam(':Location', $Location);
$stmt->bindParam(':Industry', $Industry);
$stmt->bindParam(':RH_mail', $RH_mail);
$stmt->bindParam(':RH_password', $RH_password);
$stmt->bindParam(':RH_identifiant', $RH_identifiant);

$stmt->execute();

$response = ["success" => true, "message" => "Inscription réussie"];
echo json_encode($response);
} catch (PDOException $e) {
    $response = ["success" => false, "message" => "Erreur lors de l'inscription : " . $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}
?>