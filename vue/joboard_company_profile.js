// Attendre que le document HTML soit complètement chargé
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez les éléments HTML que vous souhaitez mettre à jour
    const companyNameElement = document.getElementById("companyName");
    const locationElement = document.getElementById("location");
    const industryElement = document.getElementById("industry");
    const rhEmailElement = document.getElementById("rhEmail");
    const rhIdentifiantElement = document.getElementById("rhIdentifiant");

    // Sélectionnez le formulaire HTML
    const companyForm = document.getElementById("companyForm");

    // Sélectionnez le bouton "Mettre à jour"
    const modifyButton = document.getElementById("modifyButton");

    // Ajoutez un gestionnaire d'événements pour le bouton "Mettre à jour"
    modifyButton.addEventListener("click", function (e) {
        e.preventDefault();

        // Collectez les données du formulaire
        const updatedData = {
            companyName: document.getElementById("companyNameInput").value,
            location: document.getElementById("locationInput").value,
            industry: document.getElementById("industryInput").value,
            rhEmail: document.getElementById("rhEmailInput").value,
            rhIdentifiant: document.getElementById("rhIdentifiantInput").value
        };
        // Effectuez une requête Fetch pour envoyer les données mises à jour au serveur
        fetch("../controller/update_company_profile.php", {
            method: "POST",
            body: JSON.stringify(updatedData),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log(data.updatedFields)
                console.log(data.params)
                // Itérer sur les champs modifiés et mettre à jour les éléments HTML correspondants
                for (let fieldName in data.updatedFields) {
                    const updatedValue = data.updatedFields[fieldName];
                    const element = document.querySelector(`#${fieldName}`);
                    if (element) {
                        element.textContent = updatedValue;
                    }
                }
                
                // Cachez le formulaire de modification et affichez les informations de l'entreprise
            } else {
                alert("Erreur lors de la mise à jour des informations de l'entreprise.");
            }
        })
        .catch((error) => {
            console.error("Erreur lors de la mise à jour des données de l'entreprise : ", error);
        });
    });

    // Effectuez une requête Fetch pour obtenir les données de l'entreprise depuis le serveur
    fetch("../controller/get_company_profile.php")
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // Mettez à jour les éléments HTML avec les données de l'entreprise
            companyNameElement.textContent = data.company.CompanyName;
            locationElement.textContent = data.company.Location;
            industryElement.textContent = data.company.Industry;
            rhEmailElement.textContent = data.company.RH_mail;
            rhIdentifiantElement.textContent = data.company.RH_identifiant;
        })
        .catch((error) => {
            console.error("Erreur lors du chargement des données de l'entreprise : ", error);
        });

        $(document).ready(function() {
            // Lorsque le bouton "Modifier le profil" est cliqué
            $("#showUpdateButton").click(function() {
                // Affiche la section de mise à jour du profil en faisant apparaître l'élément
                $("#updateSection").show();

                $(this).hide();
            });
        });

});