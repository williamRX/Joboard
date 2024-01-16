<?php
session_start();
if (isset($_SESSION['CompanyID'])) {
    // L'utilisateur est connecté, vous pouvez afficher le contenu protégé ici
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: joboard_login.php");
    exit; // Assurez-vous de terminer le script après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Advertisement Creation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="joboard.css">
    <link rel="icon" type="image/png" href="icon.png">
</head>
<body>
    <div class="container mt-5">
        <h1>Create a Job Advertisement</h1>
        <form id="formAds">
            <div class="form-group">
                <label for="jobTitle">Job Title</label>
                <input type="text" class="form-control" id="jobTitle" placeholder="Enter job title">
            </div>
            <div class="form-group">
                <label for="jobDescription">Job Description</label>
                <textarea class="form-control" id="jobDescription" rows="4" placeholder="Enter job description"></textarea>
            </div>
            <div class="form-group">
                <label for="jobType">Job Type</label>
                <select class="form-control" id="jobType">
                    <option>Full-Time</option>
                    <option>Part-Time</option>
                    <option>Contract</option>
                    <option>Freelance</option>
                    <option>Internship</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hoursPerWeek">Hours per Week</label>
                <input type="number" class="form-control" id="hoursPerWeek" placeholder="Enter hours per week">
            </div>
            <div class="form-group">
                <label for="monthlySalary">Monthly Salary ($)</label>
                <input type="number" class="form-control" id="monthlySalary" placeholder="Enter monthly salary">
            </div>
            <button type="submit" class="btn btn-primary float-right">
                     Create Ads
            </button>
            
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="joboard_company_creation.js"></script>
</body>
</html>
