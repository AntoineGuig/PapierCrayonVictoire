<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $prenom = htmlspecialchars(trim($_POST["prenom"]));
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $login = htmlspecialchars(trim($_POST["login"]));
    $adresse = htmlspecialchars(trim($_POST["adresse"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $dateNaissance = htmlspecialchars(trim($_POST["dateNaissance"]));
    $sexe = htmlspecialchars($_POST["sexe"]);

    // Validation de base
    if (!empty($prenom) && !empty($nom) && !empty($login) && !empty($adresse) && !empty($password) && !empty($dateNaissance) && !empty($sexe)) {
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $hash_password = hash('sha256', $password);

            // Vérifier si l'utilisateur existe déjà
            $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE login = ?");
            $stmt->execute([$login]);
            if ($stmt->rowCount() > 0) {
                $message = "Cet email est déjà utilisé.";
            } else {
                // Insérer dans la base de données
                $stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, prenom, adresse, login, motDePasse,numClub, dateDeNaissance, sexe) VALUES (?, ?, ?, ?, ?,NULL, ?, ?);");
                if ($stmt->execute([$nom, $prenom, $adresse, $login, $hash_password, $dateNaissance, $sexe])) {
                    $message = "Inscription réussie !";
                } else {
                    $message = "Une erreur est survenue lors de l'inscription.";
                }
            }
        } else {
            $message = "Adresse email invalide.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
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
    <a href="../index.html">Retour à la page de connexion.</a>
</body>

</html>