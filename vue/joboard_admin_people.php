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

if (isset($_POST['update'])) {
    $person_id_to_update = $_POST['person_id'];
    $new_first_name = $_POST['first_name'];
    $new_last_name = $_POST['last_name'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    $new_address = $_POST['address'];
    $new_password = $_POST['password'];
    $new_admin = $_POST['admin_update'];

    $update_query = $pdo->prepare("UPDATE People SET FirstName = :new_first_name, LastName = :new_last_name, Email = :new_email, Phone = :new_phone, Address = :new_address, Password = :new_password, admin = :new_admin WHERE PersonID = :person_id_to_update");
    $update_query->bindParam(':new_first_name', $new_first_name);
    $update_query->bindParam(':new_last_name', $new_last_name);
    $update_query->bindParam(':new_email', $new_email);
    $update_query->bindParam(':new_phone', $new_phone);
    $update_query->bindParam(':new_address', $new_address);
    $update_query->bindParam(':new_password', $new_password);
    $update_query->bindParam(':new_admin', $new_admin);
    $update_query->bindParam(':person_id_to_update', $person_id_to_update);
    $update_query->execute();
}

if (isset($_POST['delete'])) {
    $person_id_to_delete = $_POST['person_id'];

    $delete_query = $pdo->prepare("DELETE FROM People WHERE PersonID = :person_id_to_delete");
    $delete_query->bindParam(':person_id_to_delete', $person_id_to_delete);
    $delete_query->execute();
}
// Opération CREATE
if (isset($_POST['create'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    $query = $pdo->prepare("INSERT INTO People (FirstName, LastName, Email, Phone, Address, Password, admin) VALUES (:first_name, :last_name, :email, :phone, :address, :password, :admin)");
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':email', $email);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':address', $address);
    $query->bindParam(':password', $password);
    $query->bindParam(':admin', $admin);
    $query->execute();
}


// Code pour lire les personnes depuis la base de données
$query = $pdo->query("SELECT * FROM People");
$people = $query->fetchAll(PDO::FETCH_ASSOC);
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
        <!-- Card for creating a new person -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="create" value="1">
                        <h2 class="card-title">Create a New Person</h2>
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
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" name="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="admin">Admin:</label>
                            <select class="form-control" name="admin_update">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Person</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card for updating a person -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="update" value="1">
                        <h2 class="card-title">Update Person</h2>
                        <div class="form-group">
                            <label for="person_id">ID of the person to update:</label>
                            <input type="text" class="form-control" name="person_id" required>
                        </div>
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
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">New Phone:</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">New Address:</label>
                            <textarea class="form-control" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="admin">New Admin:</label>
                            <select class="form-control" name="admin_update">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Person</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Table to display people -->
<h2>List of People</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Person ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Admin</th> <!-- Nouvelle colonne pour afficher "Admin" -->
            <th>Actions</th>
        </tr>

        <?php foreach ($people as $person) { ?>
            <tr>
                <td><?php echo $person['PersonID']; ?></td>
                <td><?php echo $person['FirstName']; ?></td>
                <td><?php echo $person['LastName']; ?></td>
                <td><?php echo $person['Email']; ?></td>
                <td><?php echo $person['Phone']; ?></td>
                <td><?php echo $person['Address']; ?></td>
                <td><?php echo ($person['admin'] == 1) ? 'Yes' : 'No'; ?></td> <!-- Affiche "Yes" si admin = 1, sinon "No" -->
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="1">
                        <input type="hidden" name="person_id" value="<?php echo $person['PersonID']; ?>">
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
