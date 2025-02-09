<?php
include('../config/connexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $commentaire = htmlspecialchars(trim($_POST["commentaire"]));
    $dessin = $_FILES["dessin"]["name"];

    if (!empty($commentaire) && !empty($dessin)) {

        $chemin = '../assets/img/Dessins/' . $dessin;

        $numConcours = $pdo->query("SELECT numConcours FROM Concours WHERE statut = 'en cours'");
        $numConcours = $numConcours->fetch(PDO::FETCH_ASSOC);
        $numConcours = $numConcours['numConcours'];

        $clubUtilisateur = ("SELECT COUNT(numCompetiteur) as nbUtilisateur FROM CompetiteurParticipeConcours WHERE numCompetiteur = :numUtilisateur AND numConcours = :numConcours");
        $clubUtilisateur = $pdo->prepare($clubUtilisateur);
        $clubUtilisateur->bindParam(':numUtilisateur', $_SESSION['numUtilisateur']);
        $clubUtilisateur->bindParam(':numConcours', $numConcours);
        $clubUtilisateur->execute();
        $clubUtilisateur = $clubUtilisateur->fetch(PDO::FETCH_ASSOC);

        $nbDessins = ("SELECT COUNT(*) as nbDessins FROM Dessin WHERE numCompetiteur = :numUtilisateur AND numConcours = :numConcours");
        $nbDessins = $pdo->prepare($nbDessins);
        $nbDessins->bindParam(':numUtilisateur', $_SESSION['numUtilisateur']);
        $nbDessins->bindParam(':numConcours', $numConcours);
        $nbDessins->execute();
        $nbDessins = $nbDessins->fetch(PDO::FETCH_ASSOC);
        $nbDessins = $nbDessins['nbDessins'];

        if ($clubUtilisateur['nbUtilisateur'] != 0) {
            if ($nbDessins < 3) {
                $stmt = $pdo->prepare("INSERT INTO Dessin (numCompetiteur, numConcours, commentaire, dateRemise, leDessin) VALUES (?, ?, ?, DATE(NOW()), ?)");
                if ($stmt->execute([$_SESSION['numUtilisateur'], $numConcours, $commentaire, $chemin])) {

                    if (move_uploaded_file($_FILES['dessin']['tmp_name'], '../assets/img/Dessins/' . $dessin)) {
                        $message = "Dessin envoyé !";
                    } else {
                        $message = "Erreur lors du téléchargement du fichier.";
                    }
                } else {
                    $message = "Une erreur est survenue lors de l'envoi du dessin.";
                }
            } else {
                $message = "Vous avez déjà envoyé 3 dessins pour ce concours.";
            }
        } else {
            $message = "Vous n'êtes pas inscrit à ce concours.";
        }
    }
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/register.css" />
    <title>Inscription</title>

</head>

<body>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="../pages/deposerDessin.php">Retour à la page de dépôt des dessins.</a>
</body>

</html>