<?php
$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

session_start();

if (!isset($_SESSION['PersonID'])) {
    header("Location: login.php");
    exit;
}

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Récupérer les données POST
    $data = json_decode(file_get_contents("php://input"));

    if ($data) {
        $adID = $data->adID;
        $personID = $_SESSION['PersonID']; 
        $note = $data->note; 

        $currentTime1 = date('Y-m-d H:i:s'); 

        // Vérification si l'utilisateur a déjà postulé pour ce poste
        $query = "SELECT COUNT(*) FROM JobApplications WHERE AdID = ? AND PersonID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $adID, PDO::PARAM_INT);
        $stmt->bindParam(2, $personID, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // L'utilisateur a déjà postulé
            $response = [
                'success' => false,
                'error' => 'Vous avez déjà postulé pour ce poste.'
            ];
        } else {
            // L'utilisateur n'a pas encore postulé
            $query = "INSERT INTO JobApplications (AdID, PersonID, Status, Notes, AppliedDate) VALUES (?, ?, 'Pending', ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $adID, PDO::PARAM_INT);
            $stmt->bindParam(2, $personID, PDO::PARAM_INT);
            $stmt->bindParam(3, $note, PDO::PARAM_STR); 
            $stmt->bindParam(4, $currentTime1, PDO::PARAM_STR); 

            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => 'Application soumise avec succès.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'error' => 'Erreur lors de la soumission de l\'application: ' . $stmt->errorInfo()
                ];
            }
        }
    } else {
        $response = [
            'success' => false,
            'error' => 'Invalid data.'
        ];
    }
} catch (Exception $e) {
    http_response_code(500); // Définit le code de réponse HTTP à 500 pour indiquer une erreur interne du serveur
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
}

echo json_encode($response);
exit; 
?>
