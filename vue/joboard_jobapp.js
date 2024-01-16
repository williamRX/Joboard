function createDeleteButton(applicationId) {
    const deleteButton = document.createElement("button");
    deleteButton.classList.add("btn", "btn-danger", "float-right");
    deleteButton.innerHTML = '<i class="fas fa-times"></i>'; // Ajoutez une icône de croix rouge
    deleteButton.addEventListener("click", () => handleDelete(applicationId));
    return deleteButton;
}

function handleDelete(appId) {
    // Effectuez un appel Fetch pour supprimer l'annonce
    fetch(`../controller/DeleteApps.php?appID=${appId}`, {
        method: 'GET',
    })
        .then(response => {
            if (response.ok) {
                // Supprimez l'annonce de l'affichage après la suppression réussie
                const jobCard = document.querySelector(`[data-application-id="${appId}"]`);
                if (jobCard) {
                    jobCard.remove();
                    location.reload();
                }
            } else {
                console.error('Erreur lors de la suppression de l\'annonce.');
            }
        })
        .catch(error => {
            console.error('Erreur : ' + error.message);
        });
}


document.addEventListener('DOMContentLoaded', function () {
    const appliedJobs = document.querySelector('.applied-jobs');

    fetch('../controller/joboard_app_api.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) { // Vérifiez si les données ne sont pas vides
                const appliedJobs = document.querySelector('.applied-jobs');
                data.forEach((application, index) => {
                    // Créez une carte Bootstrap pour chaque application
                    const jobCard = document.createElement('div');
                    jobCard.classList.add('card', 'mb-3');

                    // Déterminez la classe de style en fonction du statut
                    let statusClass = ''; // Par défaut, statut = pending
                    if (application.Status == 'Accepted') {
                        statusClass = 'btn-success'; // Statut = accepted
                    } else if (application.Status == 'Rejected') {
                        statusClass = 'btn-danger'; // Statut = refused
                    } else if (application.Status == 'Pending') {
                        if(statusClass != 'btn-danger')
                        {
                            statusClass = 'btn-warning'
                        }
                    }

                    const deleteButton = createDeleteButton(application.ApplicationID);
                    jobCard.setAttribute("data-application-id", application.ApplicationID);
                    // Ajoutez le contenu de la carte
                    jobCard.innerHTML = `
                        <div class="card-body">
                            <h5 class="card-title"><strong>${application.Title}</strong></h5>
                            <p class="card-text">${application.Description}</p>
                            <button class="btn ${statusClass}">${application.Status}</button>
                            <div class="collapse" id="details${application.AdID}">
                                <p><strong>Working Time:</strong> ${application.WorkingTime}</p>
                                <p><strong>Wages:</strong> $${application.Wages} per year</p>
                                <p><strong>Posted Date:</strong> ${application.PostedDate}</p>
                                <p><strong>Work Type:</strong> ${application.WorkType}</p>
                            </div>
                        </div>
                    `;
                    appliedJobs.appendChild(deleteButton);
                    // Ajoutez la carte à l'élément .applied-jobs
                    appliedJobs.appendChild(jobCard);

                    // Ajoutez une ligne de séparation (sauf après la dernière carte)
                    if (index < data.length - 1) {
                        const separationLine = document.createElement('hr');
                        appliedJobs.appendChild(separationLine);
                    }
                });
            } else {
                // Afficher un message si les données sont vides
                const emptyContainer = document.createElement('div');
                emptyContainer.classList.add('empty-container'); // Appliquez des styles CSS appropriés

                const emptyMessage = document.createElement('div');
                emptyMessage.textContent = "You didn't apply to anything yet";
                emptyMessage.classList.add('empty-message'); // Appliquez des styles CSS appropriés

                const emptyImage = document.createElement('img');
                emptyImage.src = 'https://cdn.pixabay.com/photo/2017/08/10/03/47/guy-2617866_960_720.jpg'; // Spécifiez le chemin de votre image
                emptyImage.alt = 'Empty Image'; // Texte alternatif pour l'image
                emptyImage.style.width = '600px';
                emptyImage.style.height = 'auto';

                // Ajoutez le message et l'image au conteneur
                emptyContainer.appendChild(emptyMessage);
                emptyContainer.appendChild(emptyImage);

                // Ajoutez le conteneur au conteneur des emplois appliqués
                appliedJobs.appendChild(emptyContainer);
                // Ce qui se passe lorsque les données sont vides
                console.log('Aucune donnée trouvée.');
            }
        })
        .catch(error => {
            console.error('Une erreur s\'est produite :', error);
        });
});
