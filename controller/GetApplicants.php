<?php
// Démarrer ou reprendre une session existante
session_start();

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    error_log(json_encode($_GET));

    if (isset($_GET['jobId'])) {
        $jobId = $_GET['jobId'];

        $personName = [];

        $sqlPersonName = "SELECT FirstName, LastName, PersonID, Email, Phone
            FROM JobApplications 
            WHERE PersonID = 1 
            AND AdID = :jobId";

        $stmtPersonName = $pdo->prepare($sqlPersonName);

        $stmtPersonName->bindParam(':jobId', $jobId);

        if ($stmtPersonName->execute()) {

            $personName = $stmtPersonName->fetchAll(PDO::FETCH_ASSOC);
        }


        // Requête SQL pour récupérer les PersonID pour un emploi spécifique
        $sqlPersonIDs = "SELECT PersonID FROM JobApplications WHERE AdID = :jobId AND PersonID <> 1";

        $stmtPersonIDs = $pdo->prepare($sqlPersonIDs);

        $stmtPersonIDs->bindParam(':jobId', $jobId);

        $stmtPersonIDs->execute();

        // Récupération des PersonID sous forme de tableau associatif
        $resultsPersonIDs = $stmtPersonIDs->fetchAll(PDO::FETCH_ASSOC);

        // Créer un tableau pour stocker les informations des personnes
        $personInfo = [];

        // Boucle à travers les PersonID et récupère les informations des personnes correspondantes
        foreach ($resultsPersonIDs as $person) {
            $personID = $person['PersonID'];

            // Requête SQL pour récupérer les informations des personnes
            $sqlPersonInfo = "SELECT * FROM People WHERE PersonID = :personID";

            // Préparation de la deuxième requête SQL
            $stmtPersonInfo = $pdo->prepare($sqlPersonInfo);

            // Liaison du paramètre
            $stmtPersonInfo->bindParam(':personID', $personID);

            // Exécution de la deuxième requête SQL
            $stmtPersonInfo->execute();

            // Récupération des informations des personnes sous forme de tableau associatif
            $personInfo[] = $stmtPersonInfo->fetch(PDO::FETCH_ASSOC);
        }

        echo json_encode(["applicants" => $personInfo,"applicants2" => $personName]);
    } else {
        echo "JobID non trouvé dans les paramètres GET.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
