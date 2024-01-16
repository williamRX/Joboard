<?php
if (PHP_VERSION_ID < 70300) {
    ini_set('session.cookie_secure', 1);
} else {
    session_set_cookie_params([
        'samesite' => 'None',
        'secure' => true,
    ]);
}

session_start();
if (isset($_SESSION['CompanyID'])) {
    // L'utilisateur est connecté, vous pouvez afficher le contenu protégé ici
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: joboard_login.php");
    exit; // Assurez-vous de terminer le script après la redirection
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <a class="nav-link" href="joboard_companypage.php">Your Ads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_company_profile.php">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout_compagny.php">Log Out</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
    <div class="introductory-text">
        <h2>All your listings</h2>
        <p>Find and manage job advertisements with ease.</p>
    </div>
</div>
    <div id="jobAdsContainer" class="container">
        
    </div>
        <div class="text-center">
            <br>
            <a href="joboard_company_creation.php" class="btn btn-success btn-lg">
                <i class="fas fa-plus"></i> Create New Listing
            </a>
            <br>
            <br>
        </div>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="joboard_companypage.js"></script>
</body>
</html>