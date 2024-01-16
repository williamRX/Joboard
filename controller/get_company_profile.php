<?php
// Démarrer ou reprendre une session existante
session_start();

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Vérifier si le CompanyID est stocké en session
    if (isset($_SESSION['CompanyID'])) {
        $companyID = $_SESSION['CompanyID'];

        // Requête SQL pour récupérer les informations de l'entreprise
        $sqlCompanyInfo = "SELECT * FROM Companies WHERE CompanyID = :companyID";

        $stmtCompanyInfo = $pdo->prepare($sqlCompanyInfo);

        $stmtCompanyInfo->bindParam(':companyID', $companyID);

        $stmtCompanyInfo->execute();

        $companyInfo = $stmtCompanyInfo->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["company" => $companyInfo]);
    } else {
        echo json_encode(["company" => null]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>