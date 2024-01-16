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
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<div class="container mt-5">
    <div class="text-center">
        <h1>Login Form</h1>
    </div>

    <div class="row justify-content-center">
        <!-- Job Seeker Form -->
        <div class="col-md-6" id="checkUserForm">
            <form id="jobSeekerForm" class="bg-light p-4 rounded">
                <h2 class="text-center">Job Seeker</h2>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" class="form-control">
                    <div id="error_user_mail" class="alert" role="alert"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <div id="error_user_password" class="alert" role="alert"></div>
                </div>
                <div class="text-center">
                    <button id="submit" type="submit" class="btn btn-primary">Log in</button>
                </div>
                <div id="error_user" class="alert" role="alert"></div>
            </form>
        </div>

        <!-- HR Manager Form -->
        <div class="col-md-6">
            <form id="hrForm" class="bg-light p-4 rounded">
                <h2 class="text-center">Company</h2>
                <div class="form-group">
                    <label for="hrEmail">Company Email Address:</label>
                    <input type="email" id="rhEmail" name="rhEmail" class="form-control">
                    <div id="error_company_mail" class="alert" role="alert"></div>
                </div>
                <div class="form-group">
                    <label for="rhPassword">Password:</label>
                    <input type="password" id="rhPassword" name="rhPassword" class="form-control">
                    <div id="error_company_password" class="alert" role="alert"></div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
                <div id="error_company" class="alert" role="alert"></div>
            </form>
        </div>
        <div class="text-center mt-4">
            <a href="joboard_connect_admin.php" class="btn btn-warning">Admin</a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="module" src="joboard_login.js"></script>
</body>
</html>
