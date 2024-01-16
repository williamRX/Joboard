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

    <!-- ... Other HTML Tags ... -->

    <div class="container mt-5">
        <h1>Company Profile</h1>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="companyName">Company Name</h4>
                <p class="card-text"><strong>Location (Headquarters):</strong> <span id="location">City, Country</span></p>
                <p class="card-text"><strong>Industry:</strong> <span id="industry">Company Industry</span></p>
            </div>
        </div>

        <div class="mt-4">
            <h2>HR Recruitment</h2>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Human Resources (HR) Manager</h4>
                    <p class="card-text"><strong>HR Email:</strong> <span id="rhEmail">hr@email.com</span></p>
                    <p class="card-text"><strong>HR Identifier:</strong> <span id="rhIdentifiant">hr_identifier</span></p>
                </div>
            </div>
        </div>
        <br>
       <div class="text-center">
        <button id="showUpdateButton" class="btn btn-primary">Edit Profile</button>
        </div>
        <div id="updateSection" style="display: none;">
    <!-- Votre formulaire de mise à jour de profil et son contenu vont ici -->


        <h2>Update Company Information</h2>
        <form id="companyForm">
            <div class="form-group">
                <label for="companyNameInput">Company Name</label>
                <input type="text" class="form-control" id="companyNameInput" name="companyName">
            </div>
            <div class="form-group">
                <label for="locationInput">Location (Headquarters)</label>
                <input type="text" class="form-control" id="locationInput" name="location">
            </div>
            <div class="form-group">
                <label for="industryInput">Industry</label>
                <input type="text" class="form-control" id="industryInput" name="industry">
            </div>
            <div class="form-group">
                <label for="rhEmailInput">HR Email</label>
                <input type="email" class="form-control" id="rhEmailInput" name="rhEmail">
            </div>
            <div class="form-group">
                <label for="rhIdentifiantInput">HR Identifier</label>
                <input type="text" class="form-control" id="rhIdentifiantInput" name="rhIdentifiant">
            </div>
            <button id="modifyButton" type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    </div>
    <!-- ... Other HTML Tags ... -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="joboard_company_profile.js"></script>
</body>
</html>


