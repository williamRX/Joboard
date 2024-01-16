<?php
// Supposons que vous ayez récupéré le PersonID depuis la base de données, par exemple :
$personID = 1; // Remplacez 1 par la valeur réelle de PersonID

// Démarrez la session (si ce n'est pas déjà fait)
session_start();

// Définissez le PersonID dans la session
$_SESSION['PersonID'] = $personID;
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
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="joboard_home.php">Joboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_login.php">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="joboard_signup.php">Sign Up</a>
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

 

    <script src="joboard_home_job.js"></script>

</body>
</html>
