document.addEventListener('DOMContentLoaded', function () {
    fetch('../controller/joboard_home_job_api.php')
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
                    <button class="btn btn-primary apply-button" data-adid="${ad.AdID}">Apply</button>
                `;

                learnMoreButton.setAttribute('data-toggle', 'collapse');
                learnMoreButton.setAttribute('data-target', '#details' + ad.AdID);

                adContainer.appendChild(title);
                adContainer.appendChild(description);
                adContainer.appendChild(learnMoreButton);
                adContainer.appendChild(details);

                advertisements.appendChild(adContainer);
            });
        })
        .catch(error => {
            console.error('Une erreur s\'est produite :', error);
        });
});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('apply-button')) {
        const applyButton = event.target;
        const adID = applyButton.getAttribute('data-adid');

        // Masquer le bouton "Apply"
        applyButton.style.display = 'none';

        // Créez les champs du formulaire dynamiquement
        const form = document.createElement('form');
        form.classList.add('application-form');

        const firstnameInput = document.createElement('input');
        firstnameInput.type = 'text';
        firstnameInput.id = 'firstname';
        firstnameInput.name = 'firstname';
        firstnameInput.classList.add('form-control');
        firstnameInput.placeholder = 'Firstname';

        const lastnameInput = document.createElement('input');
        lastnameInput.type = 'text';
        lastnameInput.id = 'lastname';
        lastnameInput.name = 'lastname';
        lastnameInput.classList.add('form-control');
        lastnameInput.placeholder = 'Lastname';

        const emailInput = document.createElement('input');
        emailInput.type = 'email';
        emailInput.id = 'email';
        emailInput.name = 'email';
        emailInput.classList.add('form-control');
        emailInput.placeholder = 'E-mail';

        const phoneInput = document.createElement('input');
        phoneInput.type = 'tel';
        phoneInput.id = 'phone';
        phoneInput.name = 'phone';
        phoneInput.classList.add('form-control');
        phoneInput.placeholder = 'Phone';

        const noteInput = document.createElement('textarea');
        noteInput.id = 'note';
        noteInput.name = 'note';
        noteInput.classList.add('form-control');
        noteInput.placeholder = 'Note (optional)';

        const submitButton = document.createElement('button');
        submitButton.type = 'button';
        submitButton.classList.add('btn', 'btn-primary', 'submit-button');
        submitButton.textContent = 'Submit Application';

        // Ajoutez les champs au formulaire
        form.appendChild(firstnameInput);
        form.appendChild(lastnameInput);
        form.appendChild(emailInput);
        form.appendChild(phoneInput);
        form.appendChild(noteInput);
        form.appendChild(submitButton);

        // Ajoutez le formulaire à la place du bouton "Apply"
        applyButton.parentElement.appendChild(form);
        
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('submit-button')) {
                const submitButton = event.target;
                const adIDForSubmission = adID; // Récupérez l'adID à partir de l'élément précédent
                // Vérifiez si les champs de formulaire existent
                const firstnameInput = submitButton.parentElement.querySelector('#firstname');
                const lastnameInput = submitButton.parentElement.querySelector('#lastname');
                const emailInput = submitButton.parentElement.querySelector('#email');
                const phoneInput = submitButton.parentElement.querySelector('#phone');
                const noteInput = submitButton.parentElement.querySelector('#note');

                
                if (firstnameInput && lastnameInput && emailInput && phoneInput && noteInput) {
                    const firstname = firstnameInput.value;
                    const lastname = lastnameInput.value;
                    const email = emailInput.value;
                    const phone = phoneInput.value;
                    const note = noteInput.value;
        
                    // Effectuer la requête Fetch pour envoyer les données
                    fetch('../controller/disconnect_apply_button.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            adID: adIDForSubmission,
                            firstname,
                            lastname,
                            email,
                            phone,
                            note
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            form.style.display = 'none';

                        } else {
                            // Une erreur s'est produite lors de la candidature
                            console.error(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Une erreur s\'est produite :', error);
                    });
                } else {
                    console.error('Champs de formulaire introuvables.');
                }
            }
        });
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
