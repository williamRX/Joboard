document.addEventListener('DOMContentLoaded', function () {
    
    fetch('../controller/joboard_jobpage_api.php') 
        .then(response => response.json())
        .then(data => {
            const advertisements = document.querySelector('.advertisements');
            data.forEach(ad => {
                const adContainer = document.createElement('div');
                adContainer.classList.add('advertisement');

                const title = document.createElement('div');
                title.classList.add('title');
                title.textContent = ad.Title;

                const description = document.createElement('div');
                description.classList.add('description');
                description.textContent = ad.Description;

                const learnMoreButton = document.createElement('button');
                learnMoreButton.classList.add('btn', 'btn-primary');
                learnMoreButton.type = 'button';
                learnMoreButton.textContent = 'Learn More';

                const details = document.createElement('div');
                details.id = 'details' + ad.AdID;
                details.classList.add('collapse');
                details.innerHTML = `
                    <p><strong>Working Time:</strong> ${ad.WorkingTime}</p>
                    <p><strong>Wages:</strong> $${ad.Wages} per year</p>
                    <p><strong>Posted Date:</strong> ${ad.PostedDate}</p>
                    <p><strong>Work Type:</strong> ${ad.WorkType}</p>
                    <input type="text" class="note-input form-control" placeholder="Your Note">
                    <button class="btn btn-success apply-button" data-adid="${ad.AdID}">Apply</button>
                    <button class="btn btn-info applied-button" style="display: none;">Applied</button>
                `;

                learnMoreButton.setAttribute('data-toggle', 'collapse');
                learnMoreButton.setAttribute('data-target', '#details' + ad.AdID);

                adContainer.appendChild(title);
                adContainer.appendChild(description);
                adContainer.appendChild(learnMoreButton);
                adContainer.appendChild(details);

                // Effectuez une requête au serveur pour vérifier si l'utilisateur a déjà postulé
                fetch('../controller/check_application.php?adID=' + ad.AdID, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(applicationData => {
                    if (applicationData.applied) {
                        // Si l'utilisateur a déjà postulé, masquez le bouton "Apply"
                        const applyButton = adContainer.querySelector('.apply-button');
                        applyButton.style.display = 'none';

                        // Montrez le bouton "Applied"
                        const appliedButton = adContainer.querySelector('.applied-button');
                        appliedButton.style.display = 'inline-block';

                        // Montrez le champ de texte de la note
                        const noteInput = adContainer.querySelector('.note-input');
                        noteInput.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Une erreur s\'est produite lors de la vérification de la candidature :', error);
                });

                advertisements.appendChild(adContainer);
            });
        })
        .catch(error => {
            console.error('Une erreur s\'est produite :', error);
        });
});

// En dehors de l'événement DOMContentLoaded
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('apply-button')) {
        const applyButton = event.target;
        const adID = applyButton.getAttribute('data-adid');
        // Trouvez le champ de texte de la note correspondant à ce bouton "Apply"
        const noteInput = applyButton.parentElement.querySelector('.note-input');
        const currentTime = new Date(); // Date actuelle au format "2023-10-10T14:33:55.892Z"

        // Extraire les composantes de la date
        const year = currentTime.getFullYear(); // Année (par exemple, 2023)
        const month = String(currentTime.getMonth() + 1).padStart(2, '0'); // Mois (ajouter +1 car les mois sont indexés à partir de 0)
        const day = String(currentTime.getDate()).padStart(2, '0'); // Jour
    
        // Créer une chaîne de caractères au format "YYYY-MM-DD"
        const currentTime1 = `${year}-${month}-${day}`;

        if (noteInput) {
            // Effectuer la requête Fetch pour créer une "Job Application" avec la note
            const note = noteInput.value;
            fetch('../controller/apply_button.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    adID,
                    note,
                    currentTime1,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remplacez le bouton "Apply" par un bouton "Applied"
                    applyButton.style.display = 'none';
                    const appliedButton = document.createElement('button');
                    appliedButton.classList.add('btn', 'btn-info', 'applied-button');
                    appliedButton.textContent = 'Applied';
                    applyButton.parentElement.appendChild(appliedButton);

                    noteInput.style.display = 'none'; 
                } else {
                    console.error('Erreur :', data.message);
                }
            })
            .catch(error => {
                console.error('Une erreur s\'est produite :', error);
            });
        }
    }
});


const searchInput = document.querySelector('#search-input');

searchInput.addEventListener('input', function () {
  const searchQuery = searchInput.value.toLowerCase();
  filterAdvertisements(searchQuery);
});

function filterAdvertisements(searchQuery) {
    const advertisements = document.querySelectorAll('.advertisement');
  
    advertisements.forEach(advertisement => {
      const title = advertisement.querySelector('.title').textContent.toLowerCase();
  
      if (title.includes(searchQuery)) {
        advertisement.style.display = 'block';
      } else {
        advertisement.style.display = 'none';
      }
    });
  }