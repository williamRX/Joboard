<?php
session_start();
if (isset($_SESSION['admin'])) {
    // L'utilisateur est connecté, vous pouvez afficher le contenu protégé ici
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location:joboard_connect_admin.php");
    exit;
}
// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'JobAdvertisements';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// Opération CREATE
if (isset($_POST['create'])) {
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $industry = $_POST['industry'];
    $rh_mail = $_POST['rh_mail'];
    $rh_password = $_POST['rh_password'];
    $rh_identifiant = $_POST['rh_identifiant'];

    $query = $pdo->prepare("INSERT INTO Companies (CompanyName, Location, Industry, RH_mail, RH_password, RH_identifiant) VALUES (:company_name, :location, :industry, :rh_mail, :rh_password, :rh_identifiant)");
    $query->bindParam(':company_name', $company_name);
    $query->bindParam(':location', $location);
    $query->bindParam(':industry', $industry);
    $query->bindParam(':rh_mail', $rh_mail);
    $query->bindParam(':rh_password', $rh_password);
    $query->bindParam(':rh_identifiant', $rh_identifiant);
    $query->execute();
}

// Opération READ
if (isset($_POST['read'])) {
    $company_id = $_POST['company_id'];

    $query = $pdo->prepare("SELECT * FROM Companies WHERE CompanyID = :company_id");
    $query->bindParam(':company_id', $company_id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

}

// Opération UPDATE
if (isset($_POST['update'])) {
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $industry = $_POST['industry'];
    $rh_mail = $_POST['rh_mail'];
    $rh_password = $_POST['rh_password'];
    $rh_identifiant = $_POST['rh_identifiant'];

    $query = $pdo->prepare("UPDATE Companies SET CompanyName = :company_name, Location = :location, Industry = :industry, RH_mail = :rh_mail, RH_password = :rh_password, RH_identifiant = :rh_identifiant WHERE CompanyID = :company_id");
    $query->bindParam(':company_id', $company_id);
    $query->bindParam(':company_name', $company_name);
    $query->bindParam(':location', $location);
    $query->bindParam(':industry', $industry);
    $query->bindParam(':rh_mail', $rh_mail);
    $query->bindParam(':rh_password', $rh_password);
    $query->bindParam(':rh_identifiant', $rh_identifiant);
    $query->execute();
}

// Opération DELETE
if (isset($_POST['delete'])) {
    $company_id = $_POST['company_id'];

    $query = $pdo->prepare("DELETE FROM Companies WHERE CompanyID = :company_id");
    $query->bindParam(':company_id', $company_id);
    $query->execute();
}

// Code pour lire les entreprises depuis la base de données
$query = $pdo->query("SELECT * FROM Companies");
$companies = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="row">
        <!-- Card for creating a new company -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="create" value="1">
                        <h2 class="card-title">Create a New Company</h2>
                        <div class="form-group">
                            <label for="company_name">Company Name:</label>
                            <input type="text" class="form-control" name="company_name" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="form-group">
                            <label for="industry">Industry:</label>
                            <input type="text" class="form-control" name="industry">
                        </div>
                        <div class="form-group">
                            <label for="rh_mail">RH Email:</label>
                            <input type="email" class="form-control" name="rh_mail" required>
                        </div>
                        <div class="form-group">
                            <label for="rh_password">RH Password:</label>
                            <input type="password" class="form-control" name="rh_password" required>
                        </div>
                        <div class="form-group">
                            <label for="rh_identifiant">RH Identifier:</label>
                            <input type="text" class="form-control" name="rh_identifiant" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Company</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card for updating a company -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="update" value="1">
                        <h2 class="card-title">Update Company</h2>
                        <div class="form-group">
                            <label for="company_id">Company ID to Update:</label>
                            <input type="text" class="form-control" name="company_id" required>
                        </div>
                        <div class="form-group">
                            <label for="company_name">New Company Name:</label>
                            <input type="text" class="form-control" name="company_name">
                        </div>
                        <div class="form-group">
                            <label for="location">New Location:</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                        <div class="form-group">
                            <label for="industry">New Industry:</label>
                            <input type="text" class="form-control" name="industry">
                        </div>
                        <div class="form-group">
                            <label for="rh_mail">New RH Email:</label>
                            <input type="email" class="form-control" name="rh_mail">
                        </div>
                        <div class="form-group">
                            <label for="rh_password">New RH Password:</label>
                            <input type="password" class="form-control" name="rh_password">
                        </div>
                        <div class="form-group">
                            <label for="rh_identifiant">New RH Identifier:</label>
                            <input type="text" class="form-control" name="rh_identifiant">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Table for displaying companies -->
    <h2>List of Companies</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Location</th>
                <th>Industry</th>
                <th>RH Email</th>
                <th>RH Password</th>
                <th>RH Identifier</th>
                <th>Actions</th>
            </tr>
            <!-- Your PHP code to populate the table goes here -->


        <?php foreach ($companies as $company) { ?>
            <tr>
                <td><?php echo $company['CompanyID']; ?></td>
                <td><?php echo $company['CompanyName']; ?></td>
                <td><?php echo $company['Location']; ?></td>
                <td><?php echo $company['Industry']; ?></td>
                <td><?php echo $company['RH_mail']; ?></td>
                <td><?php echo $company['RH_password']; ?></td>
                <td><?php echo $company['RH_identifiant']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="1">
                        <input type="hidden" name="company_id" value="<?php echo $company['CompanyID']; ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

