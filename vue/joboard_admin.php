<?php
session_start();
if (isset($_SESSION['admin'])) {
    // L'utilisateur est connecté, vous pouvez afficher le contenu protégé ici
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location:joboard_connect_admin.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Advertisements</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="joboard.css">
    <link rel="icon" type="image/png" href="icon.png">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Joboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_admin.php">
                            <i class="fas fa-home"></i> Tables
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_home.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h1 class="text-center">Choose a Table :</h1>
        <ul class="list-group">
            <li class="list-group-item"><a href="joboard_admin_advertisements.php">Advertisements</a></li>
            <li class="list-group-item"><a href="joboard_admin_companies.php">Companies</a></li>
            <li class="list-group-item"><a href="joboard_admin_jobapplications.php">Job Applications</a></li>
            <li class="list-group-item"><a href="joboard_admin_people.php">People</a></li>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
