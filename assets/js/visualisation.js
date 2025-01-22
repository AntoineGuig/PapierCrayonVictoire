function voirMesDessins() {
  document.getElementById("listeMesDessins").style.display = "flex";
  document.getElementById("listeConcours").style.display = "none";
}

function voirLesDessinsConcours() {
  document.getElementById("listeConcours").style.display = "flex";
  document.getElementById("listeMesDessins").style.display = "none";
}

function afficherDessinsConcours(numConcours) {
  document.getElementsByName("dessinConcours").forEach(function (dessin) {
    dessin.style.display = "none";
  });
  document.getElementsByName(numConcours).forEach(function (dessin) {
    dessin.style.display = "flex";
  });
}
