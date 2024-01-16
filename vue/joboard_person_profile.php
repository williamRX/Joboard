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
    <title>User Profile</title>
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
                        <a class="nav-link" href="logout.php" >Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-5">
    <h1>User Profile</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <span id="userfirstName">First name</span>
                <span id="userlastName">Last Name</span>
            </h4>
            <p class="card-text"><strong>Email:</strong> <span id="useremail">email@example.com</span></p>
            <p class="card-text"><strong>Phone:</strong> <span id="userphone">+1 (123) 456-7890</span></p>
            <p class="card-text"><strong>Address:</strong> <span id="useraddress">Adresse de l'utilisateur</span></p>
        </div>
    </div>

        <br>
        <br>
    
    <div class="text-center">
    <button id="showUpdateButton" class="btn btn-primary">Edit Profile</button>
    </div>
    <div id="updateSection" style="display: none;">

    <h2>Modify the user's information.</h2>
    <form id="userForm">
        <div class="form-group">
            <label for="firstNameInput">First Name</label>
            <input type="text" class="form-control" id="firstNameInput" name="firstName">
        </div>
        <div class="form-group">
            <label for="lastNameInput">Last Name</label>
            <input type="text" class="form-control" id="lastNameInput" name="lastName">
        </div>
        <div class="form-group">
            <label for="emailInput">Email</label>
            <input type="email" class="form-control" id="emailInput" name="email">
        </div>
        <div class="form-group">
            <label for="phoneInput">Phone</label>
            <input type="tel" class="form-control" id="phoneInput" name="phone">
        </div>
        <div class="form-group">
            <label for="addressInput">Address</label>
            <input type="text" class="form-control" id="addressInput" name="address">
        </div>
        <button id="modifyButton" type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="joboard_person_profile.js"></script>

</body>
</html>