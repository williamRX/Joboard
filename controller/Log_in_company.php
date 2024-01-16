<?php
if (PHP_VERSION_ID < 70300) {
    ini_set('session.cookie_secure', 1);
} else {
    session_set_cookie_params([
        'samesite' => 'None',
        'secure' => true,
    ]);
}

$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    $data = json_decode(file_get_contents("php://input"));

    $email = $data->email; 
    $password = $data->password; 
    
    $sql = "SELECT * FROM Companies WHERE RH_mail = :email AND RH_password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    // Vérifiez si un enregistrement correspondant a été trouvé
    if ($stmt->rowCount() > 0) {
        // Récupérez l'ID de la société stocké dans la base de données pour cet utilisateur
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $companyID = $row['CompanyID'];
        
        session_start();
        // L'utilisateur est authentifié avec succès
        
        // Stockage de l'ID de la société dans une session PHP
        $_SESSION['CompanyID'] = $companyID;
        
        echo json_encode(["success" => true, "message" => "Connexion réussie"]);
    } else {
        // Aucun enregistrement correspondant trouvé pour cet email et ce mot de passe
        echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect", "password"=>$password, "email"=>$email]);
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']);
    exit;
}
?>