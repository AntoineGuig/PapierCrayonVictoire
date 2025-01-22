function formulaireAdmin(){
        
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        // Empêche l'envoi du formulaire pour afficher le récapitulatif
        event.preventDefault();

        // Récupération des valeurs du formulaire
        const nomClub = document.getElementById("nomClub").value;
        const adresse = document.getElementById("adresse").value;
        const numTelephone = document.getElementById("numTelephone").value;
        const nombreAdherents = document.getElementById("nombreAdherents").value;
        const ville = document.getElementById("ville").value;
        const departement = document.getElementById("departement").value;
        const region = document.getElementById("region").value;

        // Création du récapitulatif
        const recap = `
            <h1>Récapitulatif</h1>
            <p><strong>Nom du club :</strong> ${nomClub}</p>
            <p><strong>Adresse :</strong> ${adresse}</p>
            <p><strong>Numéro de téléphone :</strong> ${numTelephone}</p>
            <p><strong>Nombre d'adhérents :</strong> ${nombreAdherents}</p>
            <p><strong>Ville :</strong> ${ville}</p>
            <p><strong>Département :</strong> ${departement}</p>
            <p><strong>Région :</strong> ${region}</p>
        `;

        // Affichage conditionnel dans la div récapitulatif
        const recapContainer = document.getElementById("recap-container");
        if (nom || email || motdepasse || message) {
            recapContainer.innerHTML = recap;
            recapContainer.style.display = "block";
        } else {
            recapContainer.style.display = "none";
        }

        // Optionnel : Proposer une confirmation avant la soumission finale
        if (confirm("Confirmez-vous les informations ?")) {
            form.submit();
        }
    });
}