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
                        <a class="nav-link" href="joboard_home.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <!-- Formulaire de connexion pour l'administrateur -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="adminLoginForm" class="bg-light p-4 rounded">
                    <h2 class="text-center">- Admin -</h2>
                    <div class="form-group">
                        <label for="adminUsername">Identifiant :</label>
                        <input type="text" id="adminUsername" name="adminUsername" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="adminPassword">Mot de passe :</label>
                        <input type="password" id="adminPassword" name="adminPassword" class="form-control" required>
                    </div>
                    <div id="error_admin" class="alert" role="alert"></div>
                    <div class="text-center">
                        <button id="adminLoginButton" type="submit" class="btn btn-primary">Se Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="joboard_connect_admin.js"></script>
</body>
</html>