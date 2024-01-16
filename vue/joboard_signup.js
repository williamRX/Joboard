// Sélectionnez les boutons de bascule de formulaire
const jobSeekerButton = document.getElementById('jobSeekerButton');
const companyHrButton = document.getElementById('companyHrButton');
const jobSeekerForm = document.getElementById('jobSeekerForm');
const companyHrForm = document.getElementById('companyHrForm');

function createUser(userData) {
    fetch("../controller/CreateUser.php", {
        // On effectue l'appelle fetch pour poster les données utilisateurs
        method: "POST",
        body: JSON.stringify(userData),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.text()) // Utilisez .text() pour obtenir la réponse en texte brut
    .then(data => {
        if (data) {
            window.location.href = "joboard_login.php"
        }
        console.log(data); // Affichez la réponse dans la console
    })
    .catch(error => {
        console.error(error); // Affichez les erreurs dans la console
    });
    
}

function createCompany(companyData) {
    fetch("../controller/CreateCompany.php", {
        // On effectue l'appelle fetch pour poster les données utilisateurs
        method: "POST",
        body: JSON.stringify(companyData),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.text()) // Utilisez .text() pour obtenir la réponse en texte brut
    .then(data => {
        if (data) {
            window.location.href = "joboard_login.php";
            }
        console.log(data); // Affichez la réponse dans la console
    })
    .catch(error => {
        console.error(error); // Affichez les erreurs dans la console
    });
    
}

if (jobSeekerButton && companyHrButton && jobSeekerForm && companyHrForm) {
    // Ajoutez des gestionnaires d'événements aux boutons
    jobSeekerButton.addEventListener('click', function () {
        // Affiche le formulaire Demandeur d'emploi
        jobSeekerForm.style.display = 'block';
        // Masque le formulaire Entreprise RH
        companyHrForm.style.display = 'none';
    });

    companyHrButton.addEventListener('click', function () {
        // Affiche le formulaire Entreprise RH
        companyHrForm.style.display = 'block';
        // Masque le formulaire Demandeur d'emploi
        jobSeekerForm.style.display = 'none';
    });
} else {
    console.error('Certains éléments ne peuvent pas être trouvés.');
}

document.getElementById("submit").addEventListener("click", function (e) {
    e.preventDefault();
    
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const phone = document.getElementById("telephone").value;
    const address = document.getElementById("address").value;

    // On stocke toutes les valeurs dans la userData
    const userData = {
        FirstName: nom,
        LastName: prenom,
        Email: email,
        password: password,
        Phone: phone,
        Address: address
    };
    
    // Vérification que les mots de passe correspondent
    const errorMessage = document.getElementById('error-message-user');

    if (password !== confirmPassword) {
        errorMessage.textContent = "Les mots de passe ne correspondent pas.";
        errorMessage.style.display = 'block';
    } else {
        createUser(userData);

        errorMessage.style.display = 'none'; // Pour cacher le message si les mots de passe correspondent
    }
});



document.getElementById("companyHrSignupForm").addEventListener("submit", function (e) {
    e.preventDefault();
    
    const nomEntreprise = document.getElementById("nomEntreprise").value;
    const Localisation = document.getElementById("localisation").value;
    const Industrie = document.getElementById("industrie").value;
    const IdentifiantRH = document.getElementById("identifiantRH").value;
    const MailRH = document.getElementById("emailRH").value;
    const mdpRH = document.getElementById("passwordRH").value;
    const confirmRH = document.getElementById("confirmpasswordRH").value;

    const errorMessage = document.getElementById("error-message");
    
    // Vérification que les mots de passe correspondent
    if (mdpRH !== confirmRH) {
        errorMessage.textContent = "Les mots de passe ne correspondent pas.";
        errorMessage.style.display = "block";
    } else {
        errorMessage.style.display = "none";  // Cacher le message d'erreur s'il était affiché précédemment

        // Ici, vous pouvez appeler la fonction pour soumettre les données (createCompany)
        const companyData = {
            CompanyName: nomEntreprise,
            Location: Localisation,
            Industry: Industrie,
            RH_mail: MailRH,
            RH_password: mdpRH,
            RH_identifiant: IdentifiantRH
        };
        createCompany(companyData);
    }
});
