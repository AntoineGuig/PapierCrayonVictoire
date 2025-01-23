<?php
$sql = "SELECT * FROM Concours WHERE statut = 'en cours';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$concours = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) as nombre FROM `CompetiteurParticipeConcours` WHERE numConcours = '13';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$CompetiteurNombre = $stmt->fetch(PDO::FETCH_ASSOC);

if ($concours) {
    $dateDebut = htmlspecialchars($concours['dateDebut']);
    $dateFin = htmlspecialchars($concours['dateFin']);
    $dateDebutFr =   substr($dateDebut, 8,2) . '/' .substr($dateDebut, 5,2) . '/' . substr($dateDebut, 0,4);
    $dateFinFr =   substr($dateFin, 8,2) . '/' .substr($dateFin, 5,2) . '/' . substr($dateFin, 0,4);
    $dateFin = htmlspecialchars($concours['dateFin']);

    echo "<h1 class ='align_center mrg-top-bottom'>Bienvenue pour la ".$concours['numConcours']."eme édition !</h1>
          <div class='align_center'><p class ='inline'>Le thème du concours est :&nbsp;<p class='bold inline'> ".$concours['theme']."</p>.</p><br> 
          <p class ='align_center inline'>Le concours a lieu du&nbsp;<p class='bold inline'>".$dateDebutFr."</p> au <p class='bold inline'>".$dateFinFr."</p></p><br> 
          <p class ='align_center inline'><p class='bold inline'>".$CompetiteurNombre['nombre']."</p> compétiteurs sont actuellement inscrits au concours.</p><br>
          <p class = 'bold align_center'> Pour s'inscrire à un concours, merci de vous adresser à votre directeur de club.</p></div> ";
}else{
    echo "<h1 class='align_center'> Aucun concours n'est actuellement en cours</h1> <br>";
}

?>