<?php
include('../config/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theme = htmlspecialchars(trim($_POST["theme"]));
    $dateDebut = htmlspecialchars(trim($_POST["dateDebut"]));
    $dateFin = htmlspecialchars(trim($_POST["dateFin"]));


    // Validation de base
    if (!empty($theme) && !empty($dateDebut) && !empty($dateFin)) {
        if ($dateDebut > $dateFin) {
            $message = "La date de début doit être inférieure à la date de fin.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO Concours (theme, dateDebut, dateFin, statut) VALUES (?, ?, ?, 'pas commencé');");
            if ($stmt->execute([$theme, $dateDebut, $dateFin])) {
                $message = "Création du concours !";
            } else {
                $message = "Une erreur est survenue lors de la création.";
            }
        }
    }
} else {
    $message = "Tous les champs sont obligatoires.";
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
    <a href="admin.php">Retour à la page admin.</a>
</body>

</html>