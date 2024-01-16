
function checkUser(userData) {
    fetch('../controller/Log_in_user.php', {
        method: 'POST',
        body: JSON.stringify(userData),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data); // Affichez la réponse dans la console
            window.location.href = "joboard_jobpage.php";
            console.log("Redirection vers : " + window.location.href);
            return data;
        } else {
            const error_admin = document.getElementById("error_user");
            error_user.textContent = "Email ou mot de passe incorrect.";
            error_user.style.color = "red";        }
    });
}

function checkCompany(companyData) {
    fetch('../controller/Log_in_company.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        email: companyData.rhEmail,
        password: companyData.rhPassword
      })
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.href = 'joboard_companypage.php';
        } else {
          const error_company = document.getElementById('error_company');
          error_company.textContent = 'Email ou mot de passe incorrect.';
          error_company.style.color = 'red';
        }
      });
  }
        

document.getElementById("checkUserForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const error_user_mail = document.getElementById("error_user_mail")
    const error_user_password = document.getElementById("error_user_password")

    // Vérifiez si les champs d'email et de mot de passe sont vides
    if (email.trim() === '' && password.trim() === '') {
        error_user_mail.textContent = "You need a mail to connect.";
        error_user_mail.style.color = "red";
        error_user_password.textContent = "You need a password to connect.";
        error_user_password.style.color = "red";
    }else if (email.trim() === '') {
        error_user_mail.textContent = "You need a mail to connect.";
        error_user_mail.style.color = "red";
    }else if(password.trim() === ''){
        error_user_password.textContent = "You need a password to connect.";
        error_user_password.style.color = "red";
    }else {
    const userData = {
        Email: email,
        password: password,
    };
    checkUser(userData)
}});

document.getElementById("hrForm").addEventListener("submit", function (e) {
    e.preventDefault();
    
    const rhEmail = document.getElementById("rhEmail").value;
    const rhPassword = document.getElementById("rhPassword").value;
    const error_company_mail = document.getElementById("error_company_mail")
    const error_company_password = document.getElementById("error_company_password")


    // Vérifiez si les champs d'email et de mot de passe sont vides
    if(rhEmail.trim() === ''&& rhPassword.trim() === '' ){
        error_company_mail.textContent = "You need a mail to connect.";
        error_company_mail.style.color = "red";
        error_company_password.textContent = "You need a password to connect.";
        error_company_password.style.color = "red";
    }
    else if (rhEmail.trim() === '') {
        error_company_mail.textContent = "You need a mail to connect.";
        error_company_mail.style.color = "red";
    }else if(rhPassword.trim() === ''){
        error_company_password.textContent = "You need a password to connect.";
        error_company_password.style.color = "red";
    }else {
    // Stockez toutes les valeurs dans l'objet userData
    const companyData = {
        rhEmail: rhEmail,
        rhPassword: rhPassword
    }

    // Appelez la fonction présente dans ../controller.js afin d'effectuer la requête fetch
    checkCompany(companyData)

}});