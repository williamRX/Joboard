<?php
session_start();

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Vérifier si le CompanyID est enregistré dans la session
    if (isset($_SESSION['CompanyID'])) {
        $companyId = $_SESSION['CompanyID'];

        // Requête SQL pour récupérer les données de l'entreprise
        $sqlAdvertisements = "SELECT Title, Description, PostedDate, WorkingTime, Wages, WorkType, AdID
            FROM Advertisements
            WHERE CompanyID = :companyId";

        // Préparation de la requête SQL avec PDO
        $stmtAdvertisements = $pdo->prepare($sqlAdvertisements);

        // Liaison du paramètre
        $stmtAdvertisements->bindParam(':companyId', $companyId);

        // Exécution de la requête SQL
        $stmtAdvertisements->execute();

        // Récupération des résultats sous forme de tableau associatif
        $resultsAdvertisements = $stmtAdvertisements->fetchAll(PDO::FETCH_ASSOC);

        // Réponse JSON avec les données récupérées
        echo json_encode(["success" => true, "result" => $resultsAdvertisements]);
    } else {
        echo "CompanyID non trouvé dans la session.";
    }
} catch (PDOException $e) {
    // En cas d'erreur, gestion de l'exception ici
    echo "Erreur : " . $e->getMessage();
}
?>

