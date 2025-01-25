// Fonction pour afficher les dessins de la perso connectée
function voirMesDessins() {
  document.getElementById("listeMesDessins").style.display = "flex";
  document.getElementById("listeConcours").style.display = "none";

  document.getElementById("btn1").classList.add("active");
  document.getElementById("btn2").classList.remove("active");
}

function voirLesDessinsConcours() {
  document.getElementById("listeMesDessins").style.display = "none";
  document.getElementById("listeConcours").style.display = "flex";

  document.getElementById("btn1").classList.remove("active");
  document.getElementById("btn2").classList.add("active");
}

window.onload = function () {
  var boutonsConcours = document.getElementsByClassName("concours-btn");

  for (var i = 0; i < boutonsConcours.length; i++) {
    boutonsConcours[i].onclick = function () {
      var numeroConcours = this.getAttribute("data-concours");
      var conteneurDessins = document.getElementById(
        "dessins-" + numeroConcours
      );
      if (
        conteneurDessins.style.display === "none" ||
        conteneurDessins.style.display === ""
      ) {
        var tousLesDessins =
          document.getElementsByClassName("dessins-container");
        for (var j = 0; j < tousLesDessins.length; j++) {
          tousLesDessins[j].style.display = "none";
        }
        conteneurDessins.style.display = "flex";
      } else {
        conteneurDessins.style.display = "none";
      }
    };
  }
};
