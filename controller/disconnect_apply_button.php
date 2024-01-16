<?php
$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION['PersonID'])) {
    // Rediriger l'utilisateur vers la page de connexion
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
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $email = $data->email;
        $phone = $data->phone;

        $currentTime = date('Y-m-d H:i:s');

        $query = "INSERT INTO JobApplications (AdID, PersonID, Status, Notes, AppliedDate, Firstname, Lastname, Email, Phone) VALUES (?, ?, 'Pending', ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $adID, PDO::PARAM_INT);
        $stmt->bindParam(2, $personID, PDO::PARAM_INT);
        $stmt->bindParam(3, $note, PDO::PARAM_STR);
        $stmt->bindParam(4, $currentTime, PDO::PARAM_STR);
        $stmt->bindParam(5, $firstname, PDO::PARAM_STR);
        $stmt->bindParam(6, $lastname, PDO::PARAM_STR);
        $stmt->bindParam(7, $email, PDO::PARAM_STR);
        $stmt->bindParam(8, $phone, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Application soumise avec succès.'
            ];
        } else {
            $response = [
                'success' => false,
                'error' => 'Erreur lors de la soumission de l\'application: ' . implode(", ", $stmt->errorInfo())
            ];
        }
    } else {
        $response = [
            'success' => false,
            'error' => 'Données invalides.'
        ];
    }
} catch (Exception $e) {
    http_response_code(500); 
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
}

echo json_encode($response);
exit; // Termine le script
?>
