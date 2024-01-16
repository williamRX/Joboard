<?php
$host = 'localhost'; 
$dbname = 'JobAdvertisements'; 
$user = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $data = json_decode(file_get_contents("php://input"));

    $nom = $data->FirstName;
    $prenom = $data->LastName;
    $email = $data->Email;
    $password = $data->password;
    $phone = $data->Phone;
    $address = $data->Address;

    $sql = "INSERT INTO People (FirstName, LastName, Email, password, Phone, Address) VALUES (:nom, :prenom, :email, :password, :phone, :address)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);

    $stmt->execute();

    $response = ["success" => true, "message" => "Inscription réussie"];
    echo json_encode($response);
} catch (PDOException $e) {
    $response = ["success" => false, "message" => "Erreur lors de l'inscription : " . $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}
?>
