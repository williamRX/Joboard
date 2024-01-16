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
    
    if ($data) {
    
    $email = $data->Email; // Extraire l'email de $data
    $password = $data->password; // Extraire le mot de passe de $data

    $sql = "SELECT * FROM People WHERE Email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Vérifiez si un enregistrement correspondant a été trouvé
    if ($stmt->rowCount() > 0) {
        // Récupérez le mot de passe stocké dans la base de données pour cet utilisateur
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_password = $row['password'];
        
        // Comparez le mot de passe de la base de données avec le mot de passe fourni par l'utilisateur
        if ($password == $stored_password) {
            session_start();
            // L'utilisateur est authentifié avec succès
            
            // Récupération de la clé primaire (PersonID) de l'utilisateur
            $personID = $row['PersonID'];

            // Stockage de la clé primaire dans une session PHP
            $_SESSION['PersonID'] = $personID;
            
            echo json_encode(["success" => true, "message" => "Connexion réussie", "personID" => "$personID"]);
        } else {
            // Mot de passe incorrect
            echo json_encode(["success" => false, "message" => "Mot de passe incorrect"]);
        }
    } else {
        // Aucun enregistrement correspondant trouvé pour cet email
        echo json_encode(["success" => false, "message" => "Email non trouvé"]);
    }
} else {
    // Aucune donnée valide n'a été reçue depuis la requête
    
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Données de requête non valides']);
}
} catch (PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']);
    exit;
}
