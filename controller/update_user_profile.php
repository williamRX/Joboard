<?php
// Démarrer ou reprendre une session existante
session_start();

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    if (isset($_SESSION['PersonID'])) {
        $personID = $_SESSION['PersonID'];

        // Récupérer les données du formulaire en tant que JSON
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);

        // Créez un tableau associatif pour stocker les champs modifiés
        $updateFields = array();

        if (isset($data['firstName']) && $data['firstName'] !== '') {
            $updateFields['firstName'] = $data['firstName'];
        }

        if (isset($data['lastName']) && $data['lastName'] !== '') {
            $updateFields['lastName'] = $data['lastName'];
        }

        if (isset($data['email']) && $data['email'] !== '') {
            $updateFields['email'] = $data['email'];
        }

        if (isset($data['phone']) && $data['phone'] !== '') {
            $updateFields['phone'] = $data['phone'];
        }

        if (isset($data['address']) && $data['address'] !== '') {
            $updateFields['address'] = $data['address'];
        }

        // Vérifier s'il y a des champs modifiés
        if (!empty($updateFields)) {
            // Requête SQL pour mettre à jour les informations du profil utilisateur
            $sqlUpdateUser = "UPDATE People SET ";
            
            // Créer un tableau pour stocker les paramètres de liaison
            $params = array();
            
            foreach ($updateFields as $field => $value) {
                $column = '';
                switch ($field) {
                    case 'firstName':
                        $column = 'FirstName';
                        break;
                    case 'lastName':
                        $column = 'LastName';
                        break;
                    case 'email':
                        $column = 'Email';
                        break;
                    case 'phone':
                        $column = 'Phone';
                        break;
                    case 'address':
                        $column = 'Address';
                        break;
                }
        
                if (!empty($column)) {
                    $sqlUpdateUser .= "$column = :$field, ";
                    $params[":$field"] = $value;
                }
            }
        
            // Supprimer la virgule en trop à la fin de la requête
            $sqlUpdateUser = rtrim($sqlUpdateUser, ", ");
            
            // Ajouter la clause WHERE
            $sqlUpdateUser .= " WHERE PersonID = :personID";
            
            // Préparation de la requête SQL
            $stmtUpdateUser = $pdo->prepare($sqlUpdateUser);
            
            // Liaison des paramètres
            foreach ($params as $paramName => $paramValue) {
                $stmtUpdateUser->bindValue($paramName, $paramValue);
            }
            
            $stmtUpdateUser->bindParam(':personID', $personID);
            
            // Exécution de la requête SQL
            $stmtUpdateUser->execute();
        }

        // Réponse JSON pour indiquer le succès de la mise à jour
        echo json_encode(["success" => true, "updatedFields" => $updateFields, "params" => $data]);
    } else {
        echo json_encode(["success" => false, "message" => "PersonID non trouvé en session"]);
    }
} catch (PDOException $e) {
    // En cas d'erreur, gestion de l'exception ici
    echo json_encode(["success" => false, "message" => "Erreur : " . $e->getMessage()]);
}
?>
