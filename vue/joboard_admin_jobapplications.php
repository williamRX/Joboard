<?php
session_start();
if (isset($_SESSION['admin'])) {
    // L'utilisateur est connecté, vous pouvez afficher le contenu protégé ici
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location:joboard_connect_admin.php");
    exit; // Assurez-vous de terminer le script après la redirection
}

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
    $ad_id = $_POST['ad_id'];
    $person_id = $_POST['person_id'];
    $applied_date = $_POST['applied_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    // Ajoutez les nouvelles colonnes
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = $pdo->prepare("INSERT INTO JobApplications (AdID, PersonID, AppliedDate, Status, Notes, FirstName, LastName, Email, Phone) VALUES (:ad_id, :person_id, :applied_date, :status, :notes, :first_name, :last_name, :email, :phone)");
    $query->bindParam(':ad_id', $ad_id);
    $query->bindParam(':person_id', $person_id);
    $query->bindParam(':applied_date', $applied_date);
    $query->bindParam(':status', $status);
    $query->bindParam(':notes', $notes);

    // Liez les nouvelles colonnes
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':email', $email);
    $query->bindParam(':phone', $phone);

    $query->execute();
}


// Opération READ
if (isset($_POST['read'])) {
    $application_id = $_POST['application_id'];

    $query = $pdo->prepare("SELECT * FROM JobApplications WHERE ApplicationID = :application_id");
    $query->bindParam(':application_id', $application_id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

}

// Opération UPDATE
if (isset($_POST['update'])) {
    $application_id = $_POST['application_id'];
    $ad_id = $_POST['ad_id'];
    $person_id = $_POST['person_id'];
    $applied_date = $_POST['applied_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = $pdo->prepare("UPDATE JobApplications SET AdID = :ad_id, PersonID = :person_id, AppliedDate = :applied_date, Status = :status, Notes = :notes, FirstName = :first_name, LastName = :last_name, Email = :email, Phone = :phone WHERE ApplicationID = :application_id");
    $query->bindParam(':application_id', $application_id);
    $query->bindParam(':ad_id', $ad_id);
    $query->bindParam(':person_id', $person_id);
    $query->bindParam(':applied_date', $applied_date);
    $query->bindParam(':status', $status);
    $query->bindParam(':notes', $notes);

    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':email', $email);
    $query->bindParam(':phone', $phone);

    $query->execute();
}


// Code pour lire les candidatures depuis la base de données
$query = $pdo->query("SELECT * FROM JobApplications");
$applications = $query->fetchAll(PDO::FETCH_ASSOC);
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
        <!-- Card for creating a new application -->
        <div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="create" value="1">
                <h2 class="card-title">Create a New Application</h2>
                <div class="form-group">
                    <label for="ad_id">Advertisement ID:</label>
                    <input type="text" class="form-control" name="ad_id" required>
                </div>
                <div class="form-group">
                    <label for="person_id">Person ID:</label>
                    <input type="text" class="form-control" name="person_id" required>
                </div>
                <div class="form-group">
                    <label for="applied_date">Application Date:</label>
                    <input type="date" class="form-control" name="applied_date" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" class="form-control" name="status" required>
                </div>
                <div class="form-group">
                    <label for="notes">Notes:</label>
                    <textarea class="form-control" name="notes" required></textarea>
                </div>
                <!-- Nouvelles entrées pour le formulaire "Create" -->
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Application</button>
            </form>
        </div>
    </div>
</div>

        <!-- Card for updating an application -->
        <div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="update" value="1">
                <h2 class="card-title">Update Application</h2>
                <div class="form-group">
                    <label for="application_id">ID of the application to update:</label>
                    <input type="text" class="form-control" name="application_id" required>
                </div>
                <div class="form-group">
                    <label for="ad_id">New Advertisement ID:</label>
                    <input type="text" class="form-control" name="ad_id">
                </div>
                <div class="form-group">
                    <label for="person_id">New Person ID:</label>
                    <input type="text" class="form-control" name="person_id">
                </div>
                <div class="form-group">
                    <label for="applied_date">New Application Date:</label>
                    <input type="date" class="form-control" name="applied_date">
                </div>
                <div class="form-group">
                    <label for="status">New Status:</label>
                    <input type="text" class="form-control" name="status">
                </div>
                <div class="form-group">
                    <label for="notes">New Notes:</label>
                    <textarea class="form-control" name="notes"></textarea>
                </div>
                <!-- Nouvelles entrées pour le formulaire "Update" -->
                <div class="form-group">
                    <label for="first_name">New First Name:</label>
                    <input type="text" class="form-control" name="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">New Last Name:</label>
                    <input type="text" class="form-control" name="last_name">
                </div>
                <div class="form-group">
                    <label for="email">New Email:</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="phone">New Phone:</label>
                    <input type="text" class="form-control" name="phone">
                </div>
                <button type="submit" class="btn btn-primary">Update Application</button>
            </form>
        </div>
    </div>
</div>
    </div>


<!-- Table to display applications -->
<h2>List of Applications</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Application ID</th>
            <th>Advertisement ID</th>
            <th>Person ID</th>
            <th>Application Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>First Name</th> <!-- Déplacé à la droite -->
            <th>Last Name</th> <!-- Déplacé à la droite -->
            <th>Email</th> <!-- Déplacé à la droite -->
            <th>Phone</th> <!-- Déplacé à la droite -->
            <th>Actions</th> <!-- À l'extrême droite -->
        </tr>
        <?php foreach ($applications as $application) { ?>
            <tr>
                <td><?php echo $application['ApplicationID']; ?></td>
                <td><?php echo $application['AdID']; ?></td>
                <td><?php echo $application['PersonID']; ?></td>
                <td><?php echo $application['AppliedDate']; ?></td>
                <td><?php echo $application['Status']; ?></td>
                <td><?php echo $application['Notes']; ?></td>
                <td><?php echo $application['FirstName']; ?></td> 
                <td><?php echo $application['LastName']; ?></td> 
                <td><?php echo $application['Email']; ?></td> 
                <td><?php echo $application['Phone']; ?></td> 
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="1">
                        <input type="hidden" name="application_id" value="<?php echo $application['ApplicationID']; ?>">
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