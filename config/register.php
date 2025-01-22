<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars(trim($_POST["name"]));
    $lastname = htmlspecialchars(trim($_POST["lastname"]));
    $email = htmlspecialchars(trim($_POST["login"]));
    $address = htmlspecialchars(trim($_POST["address"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $birthdate = htmlspecialchars(trim($_POST["birth-date"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));

    // Validation de base
    if (!empty($name) && !empty($lastname) && !empty($email) && !empty($address) && !empty($password) && !empty($birthdate) && !empty($gender)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hash_password = hash('sha256', $password);

            // Vérifier si l'utilisateur existe déjà
            $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE login = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $message = "Cet email est déjà utilisé.";
            } else {
                // Insérer dans la base de données
                $stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, prenom, adresse, login, motDePasse, dateDeNaissance, sexe) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$lastname, $name, $address, $email, $hash_password, $birthdate, $gender])) {
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
