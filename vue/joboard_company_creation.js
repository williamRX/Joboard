function createAds(adsData) {
    fetch("../controller/CreateAdvertissements.php", {
        method: "POST",
        body: JSON.stringify(adsData),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.text()) 
    .then(data => {
        if (data) {
            window.location.href = "joboard_companypage.php";}
        else {
            window.location.href = "joboard_company_creation.php";
            alert("Identifiant ou mot de passe incorrect");
        }
        
    })
    .catch(error => {
        console.error(error); // Affichez les erreurs dans la console
    });
    
}

document.getElementById("formAds").addEventListener("submit", function (e) {
    e.preventDefault();

    const JobTitle = document.getElementById("jobTitle").value;
    const JobDescription = document.getElementById("jobDescription").value;
    const JobType = document.getElementById("jobType").value;
    const WeeklyTime = document.getElementById("hoursPerWeek").value;
    const Salary = document.getElementById("monthlySalary").value;

    const currentTime = new Date(); 

    const year = currentTime.getFullYear(); 
    const month = String(currentTime.getMonth() + 1).padStart(2, '0'); 
    const day = String(currentTime.getDate()).padStart(2, '0'); 

    const currentTime1 = `${year}-${month}-${day}`;
    
    const adsData = {
        Title: JobTitle,
        Description: JobDescription,
        WorkType: JobType,
        WorkingTime: WeeklyTime,
        Wages: Salary,
        PostedDate: currentTime1, // Ajoutez l'heure de publication
    };

    createAds(adsData);
});

