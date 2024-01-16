<?php
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

        // Récupérer les données du formulaire en tant que JSON
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);

        // Créez un tableau associatif pour stocker les champs modifiés
        $updateFields = array();

        if (isset($data['companyName']) && $data['companyName'] !== '') {
            $updateFields['companyName'] = $data['companyName'];
        }

        if (isset($data['location']) && $data['location'] !== '') {
            $updateFields['location'] = $data['location'];
        }

        if (isset($data['industry']) && $data['industry'] !== '') {
            $updateFields['industry'] = $data['industry'];
        }

        if (isset($data['rhEmail']) && $data['rhEmail'] !== '') {
            $updateFields['rhEmail'] = $data['rhEmail'];
        }

        if (isset($data['rhIdentifiant']) && $data['rhIdentifiant'] !== '') {
            $updateFields['rhIdentifiant'] = $data['rhIdentifiant'];
        }

        // Vérifier s'il y a des champs modifiés
        if (!empty($updateFields)) {
            // Requête SQL pour mettre à jour les informations de l'entreprise
            $sqlUpdateCompany = "UPDATE Companies SET ";
            
            $params = array();
            
            foreach ($updateFields as $field => $value) {
                $column = '';
                switch ($field) {
                    case 'companyName':
                        $column = 'CompanyName';
                        break;
                    case 'location':
                        $column = 'Location';
                        break;
                    case 'industry':
                        $column = 'Industry';
                        break;
                    case 'rhEmail':
                        $column = 'RH_mail';
                        break;
                    case 'rhIdentifiant':
                        $column = 'RH_identifiant';
                        break;
                }
        
                if (!empty($column)) {
                    $sqlUpdateCompany .= "$column = :$field, ";
                    $params[":$field"] = $value;
                }
            }
        
            // Supprimer la virgule en trop à la fin de la requête
            $sqlUpdateCompany = rtrim($sqlUpdateCompany, ", ");
            
            // Ajouter la clause WHERE
            $sqlUpdateCompany .= " WHERE CompanyID = :companyID";
            
            $stmtUpdateCompany = $pdo->prepare($sqlUpdateCompany);
            
            foreach ($params as $paramName => $paramValue) {
                $stmtUpdateCompany->bindValue($paramName, $paramValue);
            }
            
            $stmtUpdateCompany->bindParam(':companyID', $companyID);
            
            $stmtUpdateCompany->execute();
        }

        // Réponse JSON pour indiquer le succès de la mise à jour
        echo json_encode(["success" => true, "updatedFields" => $updateFields]);
    } else {
        echo json_encode(["success" => false, "message" => "CompanyID non trouvé en session"]);
    }
} catch (PDOException $e) {
    // En cas d'erreur, gestion de l'exception ici
    echo json_encode(["success" => false, "message" => "Erreur : " . $e->getMessage()]);
}
?>
