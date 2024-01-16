document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez les éléments HTML que vous souhaitez mettre à jour
    const userFirstNameElement = document.getElementById("userfirstName");
    const userLastNameElement = document.getElementById("userlastName");
    const userEmailElement = document.getElementById("useremail");
    const userPhoneElement = document.getElementById("userphone");
    const userAddressElement = document.getElementById("useraddress");

    // Sélectionnez le formulaire HTML
    const userForm = document.getElementById("userForm");

    // Sélectionnez le bouton "Mettre à jour"
    const modifyButton = document.getElementById("modifyButton");

    // Ajoutez un gestionnaire d'événements pour le bouton "Mettre à jour"
    modifyButton.addEventListener("click", function (e) {
        e.preventDefault();

        // Collectez les données du formulaire
        const updatedData = {
            firstName: document.getElementById("firstNameInput").value,
            lastName: document.getElementById("lastNameInput").value,
            email: document.getElementById("emailInput").value,
            phone: document.getElementById("phoneInput").value,
            address: document.getElementById("addressInput").value
        };
        console.log(updatedData);
        // Effectuez une requête Fetch pour envoyer les données mises à jour au serveur
        fetch("../controller/update_user_profile.php", {
            method: "POST",
            body: JSON.stringify(updatedData),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.success) {
                console.log(data.updatedFields)
                console.log(data.params)
                // Itérer sur les champs modifiés et mettre à jour les éléments HTML correspondants
                for (let fieldName in data.updatedFields) {
                    const updatedValue = data.updatedFields[fieldName];
                    const element = document.querySelector(`#user${fieldName}`);
                    if (element) {
                        element.textContent = updatedValue;
                    }
                }
                // Cachez le formulaire de modification et affichez les informations de l'utilisateur
                
            } else {
                alert("Erreur lors de la mise à jour des informations de l'utilisateur.");
            }
        })
        .catch((error) => {
            console.error("Erreur lors de la mise à jour des données de l'utilisateur : ", error);
        });
    });

    // Effectuez une requête Fetch pour obtenir les données de l'utilisateur depuis le serveur
    fetch("../controller/get_user_profile.php")
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // Mettez à jour les éléments HTML avec les données de l'utilisateur
            userFirstNameElement.textContent = data.user.FirstName;
            userLastNameElement.textContent = data.user.LastName;
            userEmailElement.textContent = data.user.Email;
            userPhoneElement.textContent = data.user.Phone;
            userAddressElement.textContent = data.user.Address;
        })
        .catch((error) => {
            console.error("Erreur lors du chargement des données de l'utilisateur : ", error);
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