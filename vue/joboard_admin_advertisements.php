<?php
session_start();
if (isset($_SESSION['admin'])) {
    // L'utilisateur est connecté, vous pouvez afficher le contenu protégé ici
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location:joboard_connect_admin.php");
    exit; // Assurez-vous de terminer le script après la redirection
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company_id = $_POST['company_id'];
    $posted_date = $_POST['posted_date'];
    $working_time = $_POST['working_time'];
    $wages = $_POST['wages'];
    $work_type = $_POST['work_type'];

    $query = $pdo->prepare("INSERT INTO Advertisements (Title, Description, CompanyID, PostedDate, WorkingTime, Wages, WorkType) VALUES (:title, :description, :company_id, :posted_date, :working_time, :wages, :work_type)");
    $query->bindParam(':title', $title);
    $query->bindParam(':description', $description);
    $query->bindParam(':company_id', $company_id);
    $query->bindParam(':posted_date', $posted_date);
    $query->bindParam(':working_time', $working_time);
    $query->bindParam(':wages', $wages);
    $query->bindParam(':work_type', $work_type);
    $query->execute();
}

// Opération READ
if (isset($_POST['read'])) {
    $ad_id = $_POST['ad_id'];

    $query = $pdo->prepare("SELECT * FROM Advertisements WHERE AdID = :ad_id");
    $query->bindParam(':ad_id', $ad_id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

}

// Opération UPDATE
if (isset($_POST['update'])) {
    $ad_id = $_POST['ad_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company_id = $_POST['company_id'];
    $posted_date = $_POST['posted_date'];
    $working_time = $_POST['working_time'];
    $wages = $_POST['wages'];
    $work_type = $_POST['work_type'];

    $query = $pdo->prepare("UPDATE Advertisements SET Title = :title, Description = :description, CompanyID = :company_id, PostedDate = :posted_date, WorkingTime = :working_time, Wages = :wages, WorkType = :work_type WHERE AdID = :ad_id");
    $query->bindParam(':ad_id', $ad_id);
    $query->bindParam(':title', $title);
    $query->bindParam(':description', $description);
    $query->bindParam(':company_id', $company_id);
    $query->bindParam(':posted_date', $posted_date);
    $query->bindParam(':working_time', $working_time);
    $query->bindParam(':wages', $wages);
    $query->bindParam(':work_type', $work_type);
    $query->execute();
}

// Opération DELETE
if (isset($_POST['delete'])) {
    $ad_id = $_POST['ad_id'];

    $query = $pdo->prepare("DELETE FROM Advertisements WHERE AdID = :ad_id");
    $query->bindParam(':ad_id', $ad_id);
    $query->execute();
}

// Code pour lire les annonces depuis la base de données
$query = $pdo->query("SELECT * FROM Advertisements");
$advertisements = $query->fetchAll(PDO::FETCH_ASSOC);
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
        <!-- Card for creating a job advertisement -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="create" value="1">
                        <h2 class="card-title">Create a Job Advertisement</h2>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company ID:</label>
                            <input type="text" class="form-control" name="company_id" required>
                        </div>
                        <div class="form-group">
                            <label for="posted_date">Posted Date:</label>
                            <input type="date" class="form-control" name="posted_date" required>
                        </div>
                        <div class="form-group">
                            <label for="working_time">Working Time:</label>
                            <input type="text" class="form-control" name="working_time" required>
                        </div>
                        <div class="form-group">
                            <label for="wages">Wages:</label>
                            <input type="text" class="form-control" name="wages" required>
                        </div>
                        <div class="form-group">
                            <label for="work_type">Work Type:</label>
                            <input type="text" class="form-control" name="work_type" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Advertisement</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card for updating a job advertisement -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="update" value="1">
                        <h2 class="card-title">Update Job Advertisement</h2>
                        <div class="form-group">
                            <label for="ad_id">Advertisement ID to Update:</label>
                            <input type="text" class="form-control" name="ad_id" required>
                        </div>
                        <div class="form-group">
                            <label for="title">New Title:</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">New Description:</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="company_id">New Company ID:</label>
                            <input type="text" class="form-control" name="company_id">
                        </div>
                        <div class="form-group">
                            <label for="posted_date">New Posted Date:</label>
                            <input type="date" class="form-control" name="posted_date">
                        </div>
                        <div class="form-group">
                            <label for="working_time">New Working Time:</label>
                            <input type="text" class="form-control" name="working_time">
                        </div>
                        <div class="form-group">
                            <label for="wages">New Wages:</label>
                            <input type="text" class="form-control" name="wages">
                        </div>
                        <div class="form-group">
                            <label for="work_type">New Work Type:</label>
                            <input type="text" class="form-control" name="work_type">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Advertisement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



<!-- Tableau pour afficher les annonces -->
<h2>Liste des Annonces</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>ID de la Société</th>
            <th>Date de Publication</th>
            <th>Temps de Travail</th>
            <th>Salaire</th>
            <th>Type de Travail</th> <!-- Nouvelle colonne pour le type de travail -->
            <th>Actions</th>
        </tr>
        <?php foreach ($advertisements as $advertisement) { ?>
            <tr>
                <td><?php echo $advertisement['AdID']; ?></td>
                <td><?php echo $advertisement['Title']; ?></td>
                <td><?php echo $advertisement['Description']; ?></td>
                <td><?php echo $advertisement['CompanyID']; ?></td>
                <td><?php echo $advertisement['PostedDate']; ?></td>
                <td><?php echo $advertisement['WorkingTime']; ?></td>
                <td><?php echo $advertisement['Wages']; ?></td>
                <td><?php echo $advertisement['WorkType']; ?></td> <!-- Affichage du type de travail -->
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="1">
                        <input type="hidden" name="ad_id" value="<?php echo $advertisement['AdID']; ?>">
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
