<?php
$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $data = json_decode(file_get_contents("php://input"));

    if ($data) {

        $email = $data->Email; 
        $password = $data->password; 

        $sql = "SELECT * FROM People WHERE Email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifiez si un enregistrement correspondant a été trouvé
        if ($stmt->rowCount() > 0) {
            // Récupérez le mot de passe stocké dans la base de données pour cet utilisateur
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $stored_password = $row['password'];
            $stored_admin = $row['admin'];

            // Comparez le mot de passe de la base de données avec le mot de passe fourni par l'utilisateur
            if ($password === $stored_password && $stored_admin == 1) {
                session_start();
                // L'utilisateur est authentifié avec succès

                // Stockage de la clé primaire dans une session PHP
                $_SESSION['admin'] = $stored_admin;

                echo json_encode(["success" => true, "message" => "Connexion réussie"]);
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
}
?>
