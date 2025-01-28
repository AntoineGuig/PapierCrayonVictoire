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

        $clubUtilisateur = $pdo->query("SELECT count(numCompetiteur) as nbUtilisateur FROM CompetiteurParticipeConcours WHERE numCompetiteur = " . $_SESSION['numUtilisateur'] . " AND numConcours = " . $numConcours);
        $clubUtilisateur = $clubUtilisateur->fetch(PDO::FETCH_ASSOC);

        $qteDessins = $pdo->query("SELECT COUNT(*) FROM Dessin WHERE numCompetiteur = " . $_SESSION['numUtilisateur'] . " AND numConcours = " . $numConcours);
        $qteDessins = $qteDessins->fetch(PDO::FETCH_ASSOC);
        $qteDessins = $qteDessins['COUNT(*)'];

        if ($clubUtilisateur['nbUtilisateur'] != 0) {
            if ($qteDessins < 3) {
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
    <link rel="stylesheet" href="../assets/css/register.css"/>
    <title>Inscription</title>

</head>

<body>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<a href="../pages/deposerDessin.php">Retour à la page de dépôt des dessins.</a>
</body>

</html>