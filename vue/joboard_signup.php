<?php
session_start();
if (!isset($_SESSION['PersonID'])||isset($_SESSION['PersonID'])== 1) {
    // The user is connected; you can display protected content here
} else {
    // The user is not connected; redirect them to the login page
    header("Location: joboard_jobpage.php");
    exit; // Make sure to terminate the script after the redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="joboard.css">
    <link rel="icon" type="image/png" href="icon.png">
    <script type="module" src="joboard_signup.js"></script>
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
    <div class="container mt-5">
        <h1 class="text-center">Sign Up</h1>
        <div class="text-center">
            <button id="jobSeekerButton" class="btn btn-primary">Sign Up as a Job Seeker</button>
            <button id="companyHrButton" class="btn btn-primary">Sign Up as a Company</button>
        </div>
        <form id="jobSeekerForm" class="hidden-form">
            <h2 class="text-center">Sign Up as a Job Seeker</h2>
            <form id="jobSeekerSignupForm">
                <div class="form-group">
                    <label for="nom">Last Name:</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="prenom">First Name:</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Phone Number:</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Postal Address</label>
                    <input type="text" id="address" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>
                <div class="text-center">
                    <button id="submit" type="submit" class="btn btn-primary">Sign Up</button>
                </div>
                <div id="error-message-user" style="color: red; display: none;"></div>
            </form>
        </form>
        <div id="companyHrForm" class="hidden-form">
            <h2 class="text-center">Sign Up as a Company HR</h2>
            <form id="companyHrSignupForm">
                <div class="form-group">
                    <label for="nomEntreprise">Company Name:</label>
                    <input type="text" id="nomEntreprise" name="nomEntreprise" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="localisation">Location:</label>
                    <input type="text" id="localisation" name="localisation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="industrie">Industry:</label>
                    <input type="text" id="industrie" name="industrie" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="identifiantRH">HR Identifier:</label>
                    <input type="text" id="identifiantRH" name="identifiantRH" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="emailRH">Professional Email:</label>
                    <input type="email" id="emailRH" name="emailRH" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="passwordRH">Password:</label>
                    <input type="password" id="passwordRH" name="passwordRH" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirmpasswordRH">Confirm Password:</label>
                    <input type="password" id="confirmpasswordRH" name="confirmpasswordRH" class="form-control" required>
                </div>
                <div class="text-center">
                    <button id="companyHrSubmit" type="submit" class="btn btn-primary">Sign Up</button>
                </div>
                <div id="error-message" style="color: red; display: none;"></div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
