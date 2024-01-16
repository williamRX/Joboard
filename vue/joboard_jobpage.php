<?php
session_start();
if (isset($_SESSION['PersonID']) && $_SESSION['PersonID'] != 1) {
    // The user is connected and does not have PersonID 1; you can display protected content here
} else {
    // The user is not connected or has PersonID 1; redirect them to the login page
    header("Location: joboard_login.php");
    exit; // Make sure to terminate the script after the redirection
}
?> 
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Joboard - Find Your Dream Job</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="joboard.css">
    
    <link rel="icon" type="image/png" href="icon.png">

 

    <!-- Ajoutez ici votre script joboard_jobpage.js -->


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
                        <a class="nav-link" href="joboard_jobpage.php">Job Ads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_jobapp.php">Job Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_person_profile.php">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

 

    <div class="container mt-5 text-center">

        <h1>Welcome to Joboard - Your Dream Job Awaits</h1>

        <p><i class="fas fa-arrow-right"></i> Find the perfect job for your skills and interests.</p>
        <input type="text" id="search-input" class="form-control mb-3" placeholder="Search by advertisements ...">        

        

        <!-- Ajoutez ici la section où les annonces seront affichées -->

        <div class="advertisements">

            <!-- Les annonces seront ajoutées ici par JavaScript -->

        </div>

 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 

    <script src="joboard_jobpage.js"></script>

</body>

</html>