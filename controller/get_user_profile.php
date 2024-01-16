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

        $sqlUserInfo = "SELECT * FROM People WHERE PersonID = :personID";

        $stmtUserInfo = $pdo->prepare($sqlUserInfo);

        $stmtUserInfo->bindParam(':personID', $personID);

        $stmtUserInfo->execute();

        $userInfo = $stmtUserInfo->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["user" => $userInfo]);
    } else {
        echo json_encode(["user" => null]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>