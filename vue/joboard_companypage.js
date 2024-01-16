// Fonction pour créer un bouton "Accepter" avec l'ID du candidat
function createAcceptButton(applicantId, adId) {
    const acceptButton = document.createElement("button");
    acceptButton.classList.add("btn", "btn-success");
    acceptButton.textContent = "Accept";
    acceptButton.id = `acceptButton_${applicantId}_${adId}`;
    acceptButton.addEventListener("click", () => handleAccept(applicantId, adId));
    return acceptButton;
}

// Fonction pour créer un bouton "Refuser" avec l'ID du candidat
function createRejectButton(applicantId, adId) {
    const rejectButton = document.createElement("button");
    rejectButton.classList.add("btn", "btn-danger");
    rejectButton.textContent = "Reject";
    rejectButton.id = `rejectButton_${applicantId}_${adId}`;
    rejectButton.addEventListener("click", () => handleReject(applicantId, adId));
    return rejectButton;
}

// Fonction pour créer un bouton "Accepter" avec l'Email du candidat
function createAcceptButton2(Email, adId) {
    const acceptButton = document.createElement("button");
    acceptButton.classList.add("btn", "btn-success");
    acceptButton.textContent = "Accept";
    acceptButton.id = `acceptButton_${Email}_${adId}`;
    acceptButton.addEventListener("click", () => handleAccept2(Email, adId));
    return acceptButton;
}

// Fonction pour créer un bouton "Refuser" avec l'Email du candidat
function createRejectButton2(Email) {
    const rejectButton = document.createElement("button");
    rejectButton.classList.add("btn", "btn-danger");
    rejectButton.textContent = "Reject";
    rejectButton.id = `rejectButton_${Email}_${adId}`;
    rejectButton.addEventListener("click", () => handleReject2(Email, adId));
    return rejectButton;
}

// Fonction pour créer une annonce avec les candidats
function createJobAdvertisement(jobData) {
    const advertisement = document.createElement("div");
    advertisement.classList.add("advertisement");
    advertisement.setAttribute("data-advertisement-id", jobData.AdID);
    const deleteButton = createDeleteButton(jobData.AdID);

    const title = document.createElement("div");
    title.classList.add("title");
    title.textContent = jobData.Title;

    const description = document.createElement("div");
    description.classList.add("description");
    description.textContent = jobData.Description;

    const learnMoreButton = document.createElement("button");
    learnMoreButton.classList.add("btn", "btn-primary");
    learnMoreButton.textContent = "Who applied?";
    learnMoreButton.setAttribute("type", "button");
    learnMoreButton.setAttribute("data-toggle", "collapse");
    learnMoreButton.setAttribute("data-target", `#details${jobData.AdID}`);

    const details = document.createElement("div");
    details.classList.add("collapse");
    details.id = `details${jobData.AdID}`;

    const applicantsLists = [jobData.applicants, jobData.applicants2]; // Les deux listes d'applicants

    applicantsLists.forEach((applicants, index) => {
        if (applicants.length === 0) {
            const noApplicantsButton = document.createElement("button");
            noApplicantsButton.classList.add("btn", "btn-info");
            noApplicantsButton.textContent = index === 0 ? "No one applied (user)" : "No one applied (unknown)";
            details.appendChild(noApplicantsButton);
        } else {
            const applicantsList = document.createElement("ul");
            applicantsList.classList.add("applicants-list");
            if (index == 0) {
            applicants.forEach((applicant) => {
                const applicantItem = document.createElement("li");
                const applicantName = document.createElement("span");
                applicantName.textContent = `${applicant.LastName} ${applicant.FirstName} / mail : ${applicant.Email} / phone : ${applicant.Phone}`;

                const actionButton = createActionButton(applicant.PersonID, jobData.AdID);

                applicantItem.appendChild(applicantName);
                applicantItem.appendChild(actionButton);

                applicantsList.appendChild(applicantItem);
            });

            details.appendChild(applicantsList);
        } else {
            applicants.forEach((applicant) => {
                const applicantItem = document.createElement("li");
                const applicantName = document.createElement("span");
                applicantName.textContent = `${applicant.LastName} ${applicant.FirstName} / mail : ${applicant.Email} / phone : ${applicant.Phone}`;

                const actionButton = createActionButton2(applicant.Email, jobData.AdID);

                applicantItem.appendChild(applicantName);
                applicantItem.appendChild(actionButton);
                applicantsList.appendChild(applicantItem);
            });

            details.appendChild(applicantsList);
        }
    
    
    
    
    
    
    
    }
    });

    advertisement.appendChild(deleteButton);
    advertisement.appendChild(title);
    advertisement.appendChild(description);
    advertisement.appendChild(learnMoreButton);
    advertisement.appendChild(details);

    return advertisement;
}




function createActionButton(personId, adId) {
    const actionButton = document.createElement("div");

    // Récupère le statut du candidat en effectuant une requête Fetch
    fetchStatus(personId, adId)
        .then(status => {
            if (status === "Accepted") {
                const acceptedButton = document.createElement("button");
                acceptedButton.classList.add("btn", "btn-success");
                acceptedButton.textContent = "Accepted";
                actionButton.appendChild(acceptedButton);
            } else if (status === "Rejected") {
                const rejectedButton = document.createElement("button");
                rejectedButton.classList.add("btn", "btn-danger");
                rejectedButton.textContent = "Rejected";
                actionButton.appendChild(rejectedButton);
            } else {
                // Si le statut n'est ni "Accepté" ni "Refusé, affiche les boutons "Accepter" et "Refuser"
                const acceptButton = createAcceptButton(personId, adId);
                const rejectButton = createRejectButton(personId, adId);

                actionButton.appendChild(acceptButton);
                actionButton.appendChild(rejectButton);
            }
        })
        .catch(error => {
            console.error("Erreur lors de la récupération du statut : " + error.message);
        });

    return actionButton;
}

function createActionButton2(Email, adId) {
    const actionButton = document.createElement("div");

    // Récupère le statut du candidat en effectuant une requête Fetch
    fetchStatus2(Email, adId)
        .then(status => {
            if (status === "Accepted") {
                const acceptedButton = document.createElement("button");
                acceptedButton.classList.add("btn", "btn-success");
                acceptedButton.textContent = "Accepted";
                actionButton.appendChild(acceptedButton);
            } else if (status === "Rejected") {
                const rejectedButton = document.createElement("button");
                rejectedButton.classList.add("btn", "btn-danger");
                rejectedButton.textContent = "Rejected";
                actionButton.appendChild(rejectedButton);
            } else {
                // Si le statut n'est ni "Accepté" ni "Refusé, affiche les boutons "Accepter" et "Refuser"
                const acceptButton = createAcceptButton2(Email, adId);
                const rejectButton = createRejectButton2(Email, adId);

                actionButton.appendChild(acceptButton);
                actionButton.appendChild(rejectButton);
            }
        })
        .catch(error => {
            console.error("Erreur lors de la récupération du statut : " + error.message);
        });

    return actionButton;
}

function createDeleteButton(advertisementId) {
    const deleteButton = document.createElement("button");
    deleteButton.classList.add("btn", "btn-danger", "float-right");
    deleteButton.innerHTML = '<i class="fas fa-times"></i>'; // Ajoutez une icône de croix rouge
    deleteButton.addEventListener("click", () => handleDelete(advertisementId));
    return deleteButton;
}

function handleDelete(adId) {
    console.log(adId)
    // Effectuez un appel Fetch pour supprimer l'annonce
    fetch(`../controller/DeleteAds.php?adID=${adId}`, {
        method: 'GET',
    })
    .then(response => {
        if (response.ok) {
            // Supprimez l'annonce de l'affichage après la suppression réussie
            const advertisement = document.querySelector(`[data-advertisement-id="${adId}"]`);
            if (advertisement) {
                advertisement.remove();
            }
        } else {
            console.error('Erreur lors de la suppression de l\'annonce.');
        }
    })
    .catch(error => {
        console.error('Erreur : ' + error.message);
    });
}



// Fonction pour gérer l'acceptation du candidat
function handleAccept(applicantId, adId) {
    // Envoyez une requête au serveur pour mettre à jour le statut du candidat en "Accepté"
    fetch(`../controller/HandleAccept.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ applicantId, adId, status: 'Accepted' }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Supprimez les boutons "Accepter" et "Refuser"
            const acceptButton = document.getElementById(`acceptButton_${applicantId}_${adId}`);
            const rejectButton = document.getElementById(`rejectButton_${applicantId}_${adId}`);
            
            if (acceptButton && rejectButton) {
                acceptButton.textContent = "Accepted";
                rejectButton.remove();
            }
        } else {
            console.error("Erreur lors de la mise à jour du statut : " + data.result);
        }
    })
    .catch(error => {
        console.error("Erreur : " + error.message);
    });
}

// Fonction pour gérer l'acceptation du candidat
function handleAccept2(email, adId) {
    // Envoyez une requête au serveur pour mettre à jour le statut du candidat en "Accepté"
    fetch(`../controller/HandleAccept2.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, adId, status: 'Accepted' }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Supprimez les boutons "Accepter" et "Refuser"
            const acceptButton = document.getElementById(`acceptButton_${email}_${adId}`);
            const rejectButton = document.getElementById(`rejectButton_${email}_${adId}`);
            
            if (acceptButton && rejectButton) {
                acceptButton.textContent = "Accepted";
                rejectButton.remove();
            }
        } else {
            console.error("Erreur lors de la mise à jour du statut : " + data.result);
        }
    })
    .catch(error => {
        console.error("Erreur : " + error.message);
    });
}

// Fonction pour gérer le refus du candidat
function handleReject(applicantId, adId) {
    // Envoyez une requête au serveur pour mettre à jour le statut du candidat en "Rejeté"
    fetch(`../controller/HandleReject.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ applicantId, adId, status: 'Rejected' }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Supprimez les boutons "Accepter" et "Refuser"
            const acceptButton = document.getElementById(`acceptButton_${applicantId}_${adId}`);
            const rejectButton = document.getElementById(`rejectButton_${applicantId}_${adId}`);
            
            if (acceptButton && rejectButton) {
                acceptButton.remove();
                rejectButton.textContent = "Rejected";
            }
        } else {
            console.error("Erreur lors de la mise à jour du statut : " + data.result);
        }
    })
    .catch(error => {
        console.error("Erreur : " + error.message);
    });
}

// Fonction pour gérer le refus du candidat
function handleReject2(email, adId) {
    // Envoyez une requête au serveur pour mettre à jour le statut du candidat en "Rejeté"
    fetch(`../controller/HandleReject2.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, adId, status: 'Rejected' }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Supprimez les boutons "Accepter" et "Refuser"
            const acceptButton = document.getElementById(`acceptButton_${email}_${adId}`);
            const rejectButton = document.getElementById(`rejectButton_${email}_${adId}`);
            
            if (acceptButton && rejectButton) {
                acceptButton.remove();
                rejectButton.textContent = "Rejected";
            }
        } else {
            console.error("Erreur lors de la mise à jour du statut : " + data.result);
        }
    })
    .catch(error => {
        console.error("Erreur : " + error.message);
    });
}

function fetchStatus(personId, adId) {
    return fetch(`../controller/GetStatus.php?personId=${personId}&adId=${adId}`)
        .then(response => response.json())
        .then(data => data.status)
        .catch(error => {
            console.error("Erreur lors de la récupération du statut : " + error.message);
        });
}

function fetchStatus2(Email, adId) {
    return fetch(`../controller/GetStatus2.php?Email=${Email}&adId=${adId}`)
        .then(response => response.json())
        .then(data => data.status)
        .catch(error => {
            console.error("Erreur lors de la récupération du statut : " + error.message);
        });
}

// Fonction pour récupérer les données des annonces et des candidats
function fetchJobData() {
    try {
        fetch(`../controller/AllAdvertissements.php`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const jobAdsContainer = document.getElementById("jobAdsContainer");
                    data.result.forEach((jobData) => {
                        fetchApplicantsForJob(jobData.AdID)
                            .then(data => {
                                console.log(data);
                                jobData.applicants = data.applicants;
                                jobData.applicants2 = data.applicants2
                                const advertisement = createJobAdvertisement(jobData);
                                jobAdsContainer.appendChild(advertisement);
                            });
                    });
                } else {
                    console.error("Erreur : " + data.result);
                }
            })
            .catch(error => {
                console.error("Erreur : " + error.message);
            });
    } catch (error) {
        console.error("Erreur : " + error.message);
    }
}

// Fonction pour récupérer les candidats pour un emploi spécifique
function fetchApplicantsForJob(jobId) {
    return fetch(`../controller/GetApplicants.php?jobId=${jobId}`)
        .then(response => response.json())
        .catch(error => {
            console.error("Erreur lors de la récupération des candidats : " + error.message);
        });
}

// Appelez la fonction pour récupérer les données et créer les annonces lorsque la page est chargée
window.addEventListener("load", fetchJobData);
