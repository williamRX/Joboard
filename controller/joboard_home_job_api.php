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
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    $sql = "SELECT * FROM Advertisements";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ads = json_encode($results);

    echo $ads;

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur de base de données : " . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500); // Erreur serveur
    echo json_encode(['success' => false, 'message' => 'Erreur interne du serveur']);
    exit; 
}
?>
