document.getElementById("adminLoginForm").addEventListener("submit", function (e) {
    e.preventDefault();
    // Récupérez les valeurs de l'identifiant et du mot de passe
    const email = document.getElementById("adminUsername").value;
    const password = document.getElementById("adminPassword").value;

    const userData = {
        Email: email,
        password: password,
    };

    // Appelez la fonction pour vérifier l'utilisateur
    checkUser(userData);
});

function checkUser(userData) {
    fetch('../controller/log_in_admin.php', {
        method: 'POST',
        body: JSON.stringify(userData),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "joboard_admin.php";
        } else {
            const error_admin = document.getElementById("error_admin");
            error_admin.textContent = "Email ou mot de passe incorrect.";
            error_admin.style.color = "red";

        }
    });
}
